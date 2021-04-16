<?php

namespace Modules\ShortnerLink\Tests\Feature;

use Modules\ShortnerLink\Models\Link;
use Tests\TestCase;

class LinkTest extends TestCase
{
    /** @test */
    public function canUserStoreLink()
    {
        $fake_data = Link::factory()->make()->toArray();
        $response = $this->json('POST', '/api/shortner-link/v0/links/store', $fake_data);

        $response->assertJson([
            'is_successful' => true,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas("links", [
            "id" => $response->json()["data"]["id"],
            "main_link" => $response->json()["data"]["main_link"],
            "short_link" => $response->json()["data"]["short_link"]
        ]);
    }

    /** @test */
    public function cantUserStoreWrongLink()
    {

        $response = $this->json('POST', '/api/shortner-link/v0/links/store', ["main_link" => "wrong"]);

        $response->assertJson([
            'is_successful' => false,
        ]);

        $response->assertStatus(400);

        $this->assertDatabaseMissing("links", [
            "main_link" => "wrong",
        ]);
    }

    /** @test */
    public function canUserStoreRepetedLink()
    {

        $link = Link::inRandomOrder()->first();
        $response = $this->json('POST', '/api/shortner-link/v0/links/store', [
            "main_link" => $link->main_link
        ]);

        $response->assertJson([
            'is_successful' => false,
        ]);

        $response->assertStatus(400);
    }

    /** @test */
    public function canUserSeeLinks()
    {

        $links = Link::orderBy("id", "ASC")->limit(100)->pluck("id")->toArray();
        $response =  $this->json('GET', '/api/shortner-link/v0/links', [
            "page" => 0,
            "per_page" => 100,
        ]);
        $response->assertJson([
            'is_successful' => true,
        ]);

        $response->assertStatus(200);
        $ids = array_column($response->json()['data'], 'id');


        $this->assertEqualsCanonicalizing($ids, $links);
    }

    /** @test */
    public function canUserUpdateLink()
    {
        $fake_data = Link::factory()->make()->toArray();
        $link = Link::inRandomOrder()->first();
        $fake_data["id"] = $link->id;

        $response = $this->json('POST', '/api/shortner-link/v0/links/update', $fake_data);

        $response->assertJson([
            'is_successful' => true,
        ]);

        $response->assertStatus(200);

        $expired_at = date("Y-m-d H:i:s", time() + config("link.expiration"));

        $this->assertDatabaseHas("links", [
            "id" => $response->json()["data"]["id"],
            "main_link" => $response->json()["data"]["main_link"],
            "short_link" => $response->json()["data"]["short_link"],
            "expired_at" => $expired_at
        ]);
    }

    /** @test */
    public function cantUserUpdateLinkWithWrongData()
    {
        $fake_data = [];
        $link = Link::inRandomOrder()->first();
        $fake_data["id"] = $link->id;
        $fake_data["main_link"] = "wrong";

        $response = $this->json('POST', '/api/shortner-link/v0/links/update', $fake_data);

        $response->assertJson([
            'is_successful' => false,
        ]);

        $response->assertStatus(400);


        $this->assertDatabaseHas("links", [
            "id" => $link->id,
            "main_link" => $link->main_link,
            "short_link" => $link->short_link,
            "expired_at" => $link->expired_at
        ]);
    }

    /** @test */
    public function canUserRetriveAShortLink()
    {
        $link = Link::inRandomOrder()->first();

        $response =  $this->get('/api/shortner-link/v0/' . $link->short_link);

        $response->assertJson([
            'is_successful' => true,
        ]);

        $response->assertStatus(200);

        $this->assertEquals($link->main_link, $response->json()["data"]);
    }

    /** @test */
    public function cantUserRetriveAWrongShortLink()
    {
        $link = Link::inRandomOrder()->first();

        $response =  $this->get('/api/shortner-link/v0/wrong');

        $response->assertJson([
            'is_successful' => false,
        ]);

        $response->assertStatus(400);
    }

    /** @test */
    public function canUserRetriveAShortLinkViaDatabase()
    {
        $link = Link::inRandomOrder()->first();

        $response =  $this->get('/api/shortner-link/v0/database/' . $link->short_link);

        $response->assertJson([
            'is_successful' => true,
        ]);

        $response->assertStatus(200);

        $this->assertEquals($link->main_link, $response->json()["data"]);
    }
}
