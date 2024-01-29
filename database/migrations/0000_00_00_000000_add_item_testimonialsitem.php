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

        Schema::create('testimonialsitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('testimonialsitems_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('testimonialsitem_id');
            $table->unique(['testimonialsitem_id', 'locale'], 'testimonialsitem_id_unique');
            $table->foreign('testimonialsitem_id', 'testimonialsitem_id_foreign')->references('id')->on('testimonialsitems')->onDelete('cascade');
        });

        DB::table('core_permissions')->insert(['title' => 'testimonialsitem_create']);
        DB::table('core_permissions')->insert(['title' => 'testimonialsitem_edit']);
        DB::table('core_permissions')->insert(['title' => 'testimonialsitem_show']);
        DB::table('core_permissions')->insert(['title' => 'testimonialsitem_delete']);
        DB::table('core_permissions')->insert(['title' => 'testimonialsitem_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'testimonialsitem', 'type' => 'item', 'resource' => 'testimonialsitem', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('testimonialsitems');
        Schema::dropIfExists('testimonialsitems_translations');
    }
};
