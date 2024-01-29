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
        Schema::table('homepages_translations', function ($table) {
            $table->string('slug')->nullable()->after('homepage_id')->index('slug_id');
        });

        DB::table('dev_generators')->insert(
                ['name' => 'slug', 'type' => 'field', 'resource' => 'homepage', 'resource_type' => 'page', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('homepages_translations', function ($table) {
            $table->dropColumn('slug');
        });
    }
};
