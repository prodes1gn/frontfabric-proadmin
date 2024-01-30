<?php

namespace Database\Seeders;

use App\Models\Valuesitem;
use Illuminate\Database\Seeder;
use App\Cms\CmsFacade;
use Faker\Factory as Faker;

class ValuesitemSeeder extends Seeder {

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
                        #CRUD-NEW-LANG-FIELD
                ];
            }
            Valuesitem::create($array);
            #CRUD-NEW-SEEDER-FIELD
        }
    }

}
