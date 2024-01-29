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

        Schema::create('serviceitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('serviceitems_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('serviceitem_id');
            $table->unique(['serviceitem_id', 'locale'], 'serviceitem_id_unique');
            $table->foreign('serviceitem_id', 'serviceitem_id_foreign')->references('id')->on('serviceitems')->onDelete('cascade');
        });

        DB::table('core_permissions')->insert(['title' => 'serviceitem_create']);
        DB::table('core_permissions')->insert(['title' => 'serviceitem_edit']);
        DB::table('core_permissions')->insert(['title' => 'serviceitem_show']);
        DB::table('core_permissions')->insert(['title' => 'serviceitem_delete']);
        DB::table('core_permissions')->insert(['title' => 'serviceitem_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'serviceitem', 'type' => 'item', 'resource' => 'serviceitem', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('serviceitems');
        Schema::dropIfExists('serviceitems_translations');
    }
};
