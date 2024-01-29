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

        Schema::create('systempagesitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('systempagesitems_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('systempagesitem_id');
            $table->unique(['systempagesitem_id', 'locale'], 'systempagesitem_id_unique');
            $table->foreign('systempagesitem_id', 'systempagesitem_id_foreign')->references('id')->on('systempagesitems')->onDelete('cascade');
        });

        DB::table('core_permissions')->insert(['title' => 'systempagesitem_create']);
        DB::table('core_permissions')->insert(['title' => 'systempagesitem_edit']);
        DB::table('core_permissions')->insert(['title' => 'systempagesitem_show']);
        DB::table('core_permissions')->insert(['title' => 'systempagesitem_delete']);
        DB::table('core_permissions')->insert(['title' => 'systempagesitem_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'systempagesitem', 'type' => 'item', 'resource' => 'systempagesitem', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('systempagesitems');
        Schema::dropIfExists('systempagesitems_translations');
    }
};
