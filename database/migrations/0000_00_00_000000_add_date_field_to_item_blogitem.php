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
        Schema::table('blogitems', function($table) {
            $table->date('date')->nullable()->after('id')->index('date_id');
        });
        
        DB::table('dev_generators')->insert(
                ['name' => 'date', 'type' => 'field', 'resource' => 'blogitem', 'resource_type' => 'item', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('blogitems', function($table) {
            $table->dropColumn('date');
        });
    }
};