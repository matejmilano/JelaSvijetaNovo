<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use FakerRestaurant\Provider\en_US\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MealSeeder extends Seeder
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
        $categoryID=\App\Models\Category::all()->pluck('id')->toArray();
         $categoryID[]=null;
         static $order=1;
        $meal=Meal::Create([
         'title'=> $faker->foodName ,
         'slug' => 'meal'. $order++,
         'category_id'=>$categoryID[array_rand($categoryID)] 
         ]);
 
         $fakerFr = \Faker\Factory::create();
         $fakerFr->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($fakerFr));
         DB::table('meal_translations')->insert(
             [
                 'fr'=>
                 [
                     'locale'=>'fr',
                     'title' => $fakerFr->foodName,
                     'meal_id'=>$meal->id,
                 
                 ]
             ]
                 );
                 
       
    }
}
