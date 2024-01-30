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
        Schema::create('rel_serviceitem_servicepointitem', function (Blueprint $table) {
            $table->bigInteger('serviceitem_id')->index('serviceitem_id');
            $table->bigInteger('servicepointitem_id')->index('servicepointitem_id');
        });

        DB::table('dev_generators')->insert(
                ['name' => 'servicepointdropdown', 'type' => 'field', 'resource' => 'serviceitem', 'resource_type' => 'item', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('rel_serviceitem_servicepointitem');
    }
};
