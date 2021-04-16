<?php

namespace Modules\ShortnerLink\Services;

use Illuminate\Support\Facades\Cache;
use Modules\ShortnerLink\DTO\LinkRetriveDTO;
use Modules\ShortnerLink\DTO\LinkStoreDTO;
use Modules\ShortnerLink\DTO\LinkUpdateDTO;
use Modules\ShortnerLink\Models\Link;

class ShortnerLinkService
{

    private $map = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    public function index($params)
    {
        $links = Link::when(isset($params['page']) && isset($params['per_page']), function ($query) use ($params) {
            $query->skip($params['page'] * $params['per_page'])->take($params['per_page']);
        })
            ->orderBy("id", "ASC")
            ->get();

        return serviceOk($links);
    }

    public function update(LinkUpdateDTO $link_update_dto)
    {
        $link = Link::find($link_update_dto->id);
        $link->main_link = $link_update_dto->main_link;
        $link->expired_at = date("Y-m-d H:i:s", time() + config("link.expiration"));
        $link->save();

        return serviceOk($link);
    }

    private function generateShortLink($id)
    {

        $result = [];
        while ($id > 0) {
            $result[] = $this->map[$id % 62];
            $id = floor($id / 62);
        }
        $result = array_reverse($result);

        return join("", $result);
    }

    public function store(LinkStoreDTO $link_store_dto)
    {
        $link_exist = Link::where("main_link", $link_store_dto->main_link)->first();
        if ($link_exist) {
            return $link_exist;
        }

        $link = new Link();
        $link->main_link = $link_store_dto->main_link;
        $link->short_link = $this->generateShortLink($link->getNextId());
        $link->expired_at = date("Y-m-d H:i:s", time() + config("link.expiration"));
        $link->save();

        return serviceOk($link);
    }

    public function retrive(LinkRetriveDTO $link_retrive_dto)
    {
        if (Cache::has($link_retrive_dto->short_link)) {
            return serviceOk(Cache::get($link_retrive_dto->short_link));
        }

        $dictionary = str_split($this->map);


        $i = 0;
        $base = 62;

        $input = str_split($link_retrive_dto->short_link);

        foreach ($input as $char) {
            $pos = array_search($char, $dictionary);

            $i = $i * $base + $pos;
        }

        $link = Link::where("id", $i)->where("expired_at", ">=", date("Y-m-d H:i:s", time()))
            ->select("main_link")->first();

        if (!$link) {
            return serviceError("Wrong Code");
        }
        Cache::put($link_retrive_dto->short_link, $link->main_link, 600);

        return serviceOk($link->main_link);
    }

    public function retriveDatabase(LinkRetriveDTO $link_retrive_dto)
    {
        $link = Link::where("short_link", $link_retrive_dto->short_link)
            ->where("expired_at", ">=", date("Y-m-d H:i:s", time()))
            ->select("main_link")->first();

        if (!$link) {
            return serviceError("Wrong Code");
        }

        return serviceOk($link->main_link);
    }
}
