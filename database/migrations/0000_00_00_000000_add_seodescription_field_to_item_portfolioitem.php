<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('portfolioitems_translations', function ($table) {
            $table->string('seodescription')->nullable()->after('portfolioitem_id');
        });

        DB::table('dev_generators')->insert(
                ['name' => 'seodescription', 'type' => 'field', 'resource' => 'portfolioitem', 'resource_type' => 'item', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('portfolioitems_translations', function ($table) {
            $table->dropColumn('seodescription');
        });
    }
};
