<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use FakerRestaurant\Provider\en_US\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
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
        $tag=Tag::Create([
         'title'=> $faker->fruitName() ,
         'slug' => 'tag'. $order++,
         ]);
 
         $fakerFr = \Faker\Factory::create();
         $fakerFr->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($fakerFr));
         DB::table('tag_translations')->insert(
             [
                 'fr'=>
                 [
                     'locale'=>'fr',
                     'title' => $fakerFr->fruitName(),
                     'tag_id'=>$tag->id,
                 
                 ]
             ]
                 );
       
    }
}
