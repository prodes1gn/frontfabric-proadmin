<?php

namespace Database\Seeders;

use App\Models\Portfolioitem;
use Illuminate\Database\Seeder;
use App\Cms\CmsFacade;
use Faker\Factory as Faker;

class PortfolioitemSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {


        for ($i = 1; $i < 20; $i++) {
            $array = [
                'order' => $i,
                    #CRUD-NEW-FIELD
            ];
            foreach (config('translatable.locales') as $locale) {
                $array[$locale] = [
                    'name' => fake()->text(mt_rand(5, 150)),
                        'slug' => fake()->slug(),
                    'seotitle' => fake()->text(255),
                    'seodescription' => fake()->text(255),
                    'seotype' => fake()->randomElement(array('article', 'product', 'page')),
                    #CRUD-NEW-LANG-FIELD
                ];
            }
            Portfolioitem::create($array);
            $portfolioitem = Portfolioitem::latest()->first();
            foreach (config('translatable.locales') as $locale) {
                $faker = Faker::create();
                $imageUrl = $faker->imageUrl(640, 480);
                $portfolioitem->addMediaFromUrl($imageUrl)->toMediaCollection('seoimage-' . $locale);
            }
                    $portfolioitem = Portfolioitem::latest()->first();
            $faker = Faker::create();
            $imageUrl = $faker->imageUrl(640, 480);
            $portfolioitem->addMediaFromUrl($imageUrl)->toMediaCollection('image-' . config('translatable.locale'));
                    #CRUD-NEW-SEEDER-FIELD
        }
    }

}
