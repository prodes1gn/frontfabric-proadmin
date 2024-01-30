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

        Schema::create('servicepointitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('servicepointitems_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('servicepointitem_id');
            $table->unique(['servicepointitem_id', 'locale'], 'servicepointitem_id_unique');
            $table->foreign('servicepointitem_id', 'servicepointitem_id_foreign')->references('id')->on('servicepointitems')->onDelete('cascade');
        });

        DB::table('core_permissions')->insert(['title' => 'servicepointitem_create']);
        DB::table('core_permissions')->insert(['title' => 'servicepointitem_edit']);
        DB::table('core_permissions')->insert(['title' => 'servicepointitem_show']);
        DB::table('core_permissions')->insert(['title' => 'servicepointitem_delete']);
        DB::table('core_permissions')->insert(['title' => 'servicepointitem_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'servicepointitem', 'type' => 'item', 'resource' => 'servicepointitem', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('servicepointitems');
        Schema::dropIfExists('servicepointitems_translations');
    }
};
