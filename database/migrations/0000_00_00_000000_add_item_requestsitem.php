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

        Schema::create('requestsitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('requestsitems_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('requestsitem_id');
            $table->unique(['requestsitem_id', 'locale'], 'requestsitem_id_unique');
            $table->foreign('requestsitem_id', 'requestsitem_id_foreign')->references('id')->on('requestsitems')->onDelete('cascade');
        });

        DB::table('core_permissions')->insert(['title' => 'requestsitem_create']);
        DB::table('core_permissions')->insert(['title' => 'requestsitem_edit']);
        DB::table('core_permissions')->insert(['title' => 'requestsitem_show']);
        DB::table('core_permissions')->insert(['title' => 'requestsitem_delete']);
        DB::table('core_permissions')->insert(['title' => 'requestsitem_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'requestsitem', 'type' => 'item', 'resource' => 'requestsitem', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('requestsitems');
        Schema::dropIfExists('requestsitems_translations');
    }
};
