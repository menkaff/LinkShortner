<?php

namespace Modules\ShortnerLink\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\ShortnerLink\Models\Link;

class LinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Link::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "main_link" => $this->faker->url(),
        ];
    }
}
