<?php

namespace Database\Seeders;

use App\Models\Servicepointitem;
use Illuminate\Database\Seeder;
use App\Cms\CmsFacade;
use Faker\Factory as Faker;

class ServicepointitemSeeder extends Seeder {

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
                        'text' => fake()->text(255),
                    #CRUD-NEW-LANG-FIELD
                ];
            }
            Servicepointitem::create($array);
            #CRUD-NEW-SEEDER-FIELD
        }
    }

}