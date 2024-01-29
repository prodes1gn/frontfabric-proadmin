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

        Schema::create('portfolioitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('portfolioitems_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('portfolioitem_id');
            $table->unique(['portfolioitem_id', 'locale'], 'portfolioitem_id_unique');
            $table->foreign('portfolioitem_id', 'portfolioitem_id_foreign')->references('id')->on('portfolioitems')->onDelete('cascade');
        });

        DB::table('core_permissions')->insert(['title' => 'portfolioitem_create']);
        DB::table('core_permissions')->insert(['title' => 'portfolioitem_edit']);
        DB::table('core_permissions')->insert(['title' => 'portfolioitem_show']);
        DB::table('core_permissions')->insert(['title' => 'portfolioitem_delete']);
        DB::table('core_permissions')->insert(['title' => 'portfolioitem_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'portfolioitem', 'type' => 'item', 'resource' => 'portfolioitem', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('portfolioitems');
        Schema::dropIfExists('portfolioitems_translations');
    }
};
