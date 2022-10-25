<?php

namespace Database\Factories;

use FakerRestaurant\Provider\en_US\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class IngredientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    

    public function definition()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new Restaurant($faker));
        static $order = 1;
        return [
            'title' => $faker->vegetableName,
            'slug'  => 'ingredient ' . $order++
        ];
    }
}
