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
        Schema::table('blogpages_translations', function ($table) {
            $table->mediumText('text')->nullable()->after('blogpage_id');
        });

        DB::table('dev_generators')->insert(
                ['name' => 'text', 'type' => 'field', 'resource' => 'blogpage', 'resource_type' => 'page', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('blogpages_translations', function ($table) {
            $table->dropColumn('text');
        });
    }
};
