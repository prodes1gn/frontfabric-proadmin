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

        Schema::create('blogcategoryitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('blogcategoryitems_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('blogcategoryitem_id');
            $table->unique(['blogcategoryitem_id', 'locale'], 'blogcategoryitem_id_unique');
            $table->foreign('blogcategoryitem_id', 'blogcategoryitem_id_foreign')->references('id')->on('blogcategoryitems')->onDelete('cascade');
        });

        DB::table('core_permissions')->insert(['title' => 'blogcategoryitem_create']);
        DB::table('core_permissions')->insert(['title' => 'blogcategoryitem_edit']);
        DB::table('core_permissions')->insert(['title' => 'blogcategoryitem_show']);
        DB::table('core_permissions')->insert(['title' => 'blogcategoryitem_delete']);
        DB::table('core_permissions')->insert(['title' => 'blogcategoryitem_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'blogcategoryitem', 'type' => 'item', 'resource' => 'blogcategoryitem', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('blogcategoryitems');
        Schema::dropIfExists('blogcategoryitems_translations');
    }
};
