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
        Schema::table('requestsitems_translations', function ($table) {
            $table->mediumText('text')->nullable()->after('requestsitem_id');
        });

        DB::table('dev_generators')->insert(
                ['name' => 'text', 'type' => 'field', 'resource' => 'requestsitem', 'resource_type' => 'item', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('requestsitems_translations', function ($table) {
            $table->dropColumn('text');
        });
    }
};
