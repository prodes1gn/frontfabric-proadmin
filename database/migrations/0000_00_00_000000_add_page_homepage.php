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

        Schema::create('homepages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('homepages_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('homepage_id');
            $table->unique(['homepage_id', 'locale'], 'homepage_id_unique');
            $table->foreign('homepage_id', 'homepage_id_foreign')->references('id')->on('homepages')->onDelete('cascade');
        });

        DB::table('homepages')->insert(['id' => 1]);
        DB::table('homepages_translations')->insert(
                [
                    'id' => 1,
                    'locale' => Config::get('translatable.locale'),
                    'name' => 'Homepage',
                    'homepage_id' => 1,
                ]
        );

        DB::table('core_permissions')->insert(['title' => 'homepage_edit']);
        DB::table('core_permissions')->insert(['title' => 'homepage_delete']);
        DB::table('core_permissions')->insert(['title' => 'homepage_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'homepage', 'type' => 'page', 'resource' => 'homepage', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('homepages');
        Schema::dropIfExists('homepages_translations');
    }
};
