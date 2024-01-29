<?php

namespace Database\Seeders;

use App\Models\Systempagesitem;
use Illuminate\Database\Seeder;
use App\Cms\CmsFacade;
use Faker\Factory as Faker;

class SystempagesitemSeeder extends Seeder {

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
            Systempagesitem::create($array);
            $systempagesitem = Systempagesitem::latest()->first();
            foreach (config('translatable.locales') as $locale) {
                $faker = Faker::create();
                $imageUrl = $faker->imageUrl(640, 480);
                $systempagesitem->addMediaFromUrl($imageUrl)->toMediaCollection('seoimage-' . $locale);
            }
                    #CRUD-NEW-SEEDER-FIELD
        }
    }

}
