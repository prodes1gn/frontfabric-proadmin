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

        Schema::create('blogitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('blogitems_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('blogitem_id');
            $table->unique(['blogitem_id', 'locale'], 'blogitem_id_unique');
            $table->foreign('blogitem_id', 'blogitem_id_foreign')->references('id')->on('blogitems')->onDelete('cascade');
        });

        DB::table('core_permissions')->insert(['title' => 'blogitem_create']);
        DB::table('core_permissions')->insert(['title' => 'blogitem_edit']);
        DB::table('core_permissions')->insert(['title' => 'blogitem_show']);
        DB::table('core_permissions')->insert(['title' => 'blogitem_delete']);
        DB::table('core_permissions')->insert(['title' => 'blogitem_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'blogitem', 'type' => 'item', 'resource' => 'blogitem', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('blogitems');
        Schema::dropIfExists('blogitems_translations');
    }
};
