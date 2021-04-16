<?php

namespace Modules\ShortnerLink\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ShortnerLink\DTO\LinkRetriveDTO;
use Modules\ShortnerLink\DTO\LinkStoreDTO;
use Modules\ShortnerLink\DTO\LinkUpdateDTO;

class ShortnerLinkController extends Controller
{
    /**
     * Display a listing of the Links.
     * @urlParam page optional . Example : 0 starts from zero
     * @urlParam per_page optional . Example : 10
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $result = app()->make('ShortnerLinkService')->index($params);
        if ($result['is_successful']) {
            return responseOk($result['data']);
        } else {
            return responseError($result['message']);
        }
    }

    /**
     * Store a Link.
     * @bodyParam main_link string Link for shortening . Example: https://laravel.com/
     */
    public function store(Request $request)
    {

        $link_store_dto = LinkStoreDTO::fromRequest($request);
        if ($link_store_dto->validate() === true) {
            $result = app()->make('ShortnerLinkService')->store($link_store_dto);
            if ($result['is_successful']) {
                return responseOk($result['data']);
            } else {
                return responseError($result['message']);
            }
        } else {
            return responseError($link_store_dto->validate());
        }
    }

    /**
     * Update a Link.
     * @bodyParam main_link string Link for shortening . Example: https://laravel.com/
     */
    public function update(Request $request)
    {

        $link_store_dto = LinkUpdateDTO::fromRequest($request);
        if ($link_store_dto->validate() === true) {
            $result = app()->make('ShortnerLinkService')->update($link_store_dto);
            if ($result['is_successful']) {
                return responseOk($result['data']);
            } else {
                return responseError($result['message']);
            }
        } else {
            return responseError($link_store_dto->validate());
        }
    }

    /**
     * Retirve short link
     * [write short link in url]
     */
    public function retrive($short_link)
    {
        $link_retrive_dto = LinkRetriveDTO::fromParam($short_link);
        if ($link_retrive_dto->validate() === true) {
            $result = app()->make('ShortnerLinkService')->retrive($link_retrive_dto);
            if ($result['is_successful']) {
                return responseOk($result['data']);
            } else {
                return responseError($result['message']);
            }
        } else {
            return responseError($link_retrive_dto->validate());
        }
    }

    /**
     * Retirve short link from Database
     * [write short link in url]
     */
    public function retriveDatabase($short_link)
    {
        $link_retrive_dto = LinkRetriveDTO::fromParam($short_link);
        if ($link_retrive_dto->validate() === true) {
            $result = app()->make('ShortnerLinkService')->retriveDatabase($link_retrive_dto);
            if ($result['is_successful']) {
                return responseOk($result['data']);
            } else {
                return responseError($result['message']);
            }
        } else {
            return responseError($link_retrive_dto->validate());
        }
    }
}
