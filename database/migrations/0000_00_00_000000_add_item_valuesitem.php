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

        Schema::create('valuesitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('valuesitems_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('valuesitem_id');
            $table->unique(['valuesitem_id', 'locale'], 'valuesitem_id_unique');
            $table->foreign('valuesitem_id', 'valuesitem_id_foreign')->references('id')->on('valuesitems')->onDelete('cascade');
        });

        DB::table('core_permissions')->insert(['title' => 'valuesitem_create']);
        DB::table('core_permissions')->insert(['title' => 'valuesitem_edit']);
        DB::table('core_permissions')->insert(['title' => 'valuesitem_show']);
        DB::table('core_permissions')->insert(['title' => 'valuesitem_delete']);
        DB::table('core_permissions')->insert(['title' => 'valuesitem_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'valuesitem', 'type' => 'item', 'resource' => 'valuesitem', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('valuesitems');
        Schema::dropIfExists('valuesitems_translations');
    }
};
