<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('blogpages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('blogpages_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('blogpage_id');
            $table->unique(['blogpage_id', 'locale'], 'blogpage_id_unique');
            $table->foreign('blogpage_id', 'blogpage_id_foreign')->references('id')->on('blogpages')->onDelete('cascade');
        });

        DB::table('blogpages')->insert(['id' => 1]);
        DB::table('blogpages_translations')->insert(
                [
                    'id' => 1,
                    'locale' => Config::get('translatable.locale'),
                    'name' => 'Blogpage',
                    'blogpage_id' => 1,
                ]
        );

        DB::table('core_permissions')->insert(['title' => 'blogpage_edit']);
        DB::table('core_permissions')->insert(['title' => 'blogpage_delete']);
        DB::table('core_permissions')->insert(['title' => 'blogpage_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'blogpage', 'type' => 'page', 'resource' => 'blogpage', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('blogpages');
        Schema::dropIfExists('blogpages_translations');
    }
};
