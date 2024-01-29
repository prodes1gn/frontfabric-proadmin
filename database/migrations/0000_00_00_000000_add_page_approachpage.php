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

        Schema::create('approachpages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('approachpages_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('approachpage_id');
            $table->unique(['approachpage_id', 'locale'], 'approachpage_id_unique');
            $table->foreign('approachpage_id', 'approachpage_id_foreign')->references('id')->on('approachpages')->onDelete('cascade');
        });

        DB::table('approachpages')->insert(['id' => 1]);
        DB::table('approachpages_translations')->insert(
                [
                    'id' => 1,
                    'locale' => Config::get('translatable.locale'),
                    'name' => 'Approachpage',
                    'approachpage_id' => 1,
                ]
        );

        DB::table('core_permissions')->insert(['title' => 'approachpage_edit']);
        DB::table('core_permissions')->insert(['title' => 'approachpage_delete']);
        DB::table('core_permissions')->insert(['title' => 'approachpage_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'approachpage', 'type' => 'page', 'resource' => 'approachpage', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('approachpages');
        Schema::dropIfExists('approachpages_translations');
    }
};
