<?php

namespace Database\Seeders;

use App\Models\Ingredients;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use FakerRestaurant\Provider\en_US\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new Restaurant($faker));
        static $order=1;
        $ingredient=Ingredients::Create([
         'title'=> $faker->dairyName() ,
         'slug' => 'ingredient'. $order++,
         ]);
 
         $fakerFr = \Faker\Factory::create();
         $fakerFr->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($fakerFr));
         DB::table('ingredients_translations')->insert(
             [
                 'fr'=>
                 [
                     'locale'=>'fr',
                     'title' => $fakerFr->dairyName(),
                     'ingredients_id'=>$ingredient->id,
                 
                 ]
             ]
                 );
    }
}
