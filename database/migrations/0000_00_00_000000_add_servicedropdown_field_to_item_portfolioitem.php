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
        Schema::create('rel_portfolioitem_serviceitem', function (Blueprint $table) {
            $table->bigInteger('portfolioitem_id')->index('portfolioitem_id');
            $table->bigInteger('serviceitem_id')->index('serviceitem_id');
        });

        DB::table('dev_generators')->insert(
                ['name' => 'servicedropdown', 'type' => 'field', 'resource' => 'portfolioitem', 'resource_type' => 'item', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('rel_portfolioitem_serviceitem');
    }
};
