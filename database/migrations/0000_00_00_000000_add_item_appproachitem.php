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

        Schema::create('appproachitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('appproachitems_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('appproachitem_id');
            $table->unique(['appproachitem_id', 'locale'], 'appproachitem_id_unique');
            $table->foreign('appproachitem_id', 'appproachitem_id_foreign')->references('id')->on('appproachitems')->onDelete('cascade');
        });

        DB::table('core_permissions')->insert(['title' => 'appproachitem_create']);
        DB::table('core_permissions')->insert(['title' => 'appproachitem_edit']);
        DB::table('core_permissions')->insert(['title' => 'appproachitem_show']);
        DB::table('core_permissions')->insert(['title' => 'appproachitem_delete']);
        DB::table('core_permissions')->insert(['title' => 'appproachitem_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'appproachitem', 'type' => 'item', 'resource' => 'appproachitem', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('appproachitems');
        Schema::dropIfExists('appproachitems_translations');
    }
};
