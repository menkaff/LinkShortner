<?php

namespace Modules\ShortnerLink\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\ShortnerLink\Models\Link;

class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        for ($i = 0; $i < 5000; $i++) {
            $faker = \Faker\Factory::create();
            $main_link = $faker->url();
            $link_exist = Link::where("main_link", $main_link)->first();
            if ($link_exist) {
                continue;
            }

            $link = new Link();
            $id = $link->getNextId();

            $map = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $result = [];
            while ($id > 0) {
                $result[] = $map[$id % 62];
                $id = floor($id / 62);
            }
            $result = array_reverse($result);

            $short_link = join("", $result);

            $link->main_link = $main_link;
            $link->short_link = $short_link;
            $link->expired_at = date("Y-m-d H:i:s", time() + config("link.expiration"));
            $link->save();
        }
    }
}
