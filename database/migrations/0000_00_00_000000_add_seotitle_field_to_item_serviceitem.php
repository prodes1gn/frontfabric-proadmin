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
        Schema::table('serviceitems_translations', function ($table) {
            $table->string('seotitle')->nullable()->after('serviceitem_id');
        });

        DB::table('dev_generators')->insert(
                ['name' => 'seotitle', 'type' => 'field', 'resource' => 'serviceitem', 'resource_type' => 'item', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('serviceitems_translations', function ($table) {
            $table->dropColumn('seotitle');
        });
    }
};
