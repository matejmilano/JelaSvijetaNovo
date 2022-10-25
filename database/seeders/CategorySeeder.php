<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use FakerRestaurant\Provider\en_US\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
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
        $category=Category::Create([
         'title'=> $faker->dairyName() ,
         'slug' => 'category'. $order++,
         ]);
 
         $fakerFr = \Faker\Factory::create();
         $fakerFr->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($fakerFr));
         DB::table('category_translations')->insert(
             [
                 'fr'=>
                 [
                     'locale'=>'fr',
                     'title' => $fakerFr->dairyName(),
                     'category_id'=>$category->id,
                 
                 ]
             ]
                 );
    }
}
