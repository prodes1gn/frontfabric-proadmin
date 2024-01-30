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
        Schema::table('aboutuspages_translations', function ($table) {
            $table->mediumText('whyus')->nullable()->after('aboutuspage_id');
        });

        DB::table('dev_generators')->insert(
                ['name' => 'whyus', 'type' => 'field', 'resource' => 'aboutuspage', 'resource_type' => 'page', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('aboutuspages_translations', function ($table) {
            $table->dropColumn('whyus');
        });
    }
};
