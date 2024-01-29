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

        Schema::create('servicespages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('servicespages_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('servicespage_id');
            $table->unique(['servicespage_id', 'locale'], 'servicespage_id_unique');
            $table->foreign('servicespage_id', 'servicespage_id_foreign')->references('id')->on('servicespages')->onDelete('cascade');
        });

        DB::table('servicespages')->insert(['id' => 1]);
        DB::table('servicespages_translations')->insert(
                [
                    'id' => 1,
                    'locale' => Config::get('translatable.locale'),
                    'name' => 'Servicespage',
                    'servicespage_id' => 1,
                ]
        );

        DB::table('core_permissions')->insert(['title' => 'servicespage_edit']);
        DB::table('core_permissions')->insert(['title' => 'servicespage_delete']);
        DB::table('core_permissions')->insert(['title' => 'servicespage_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'servicespage', 'type' => 'page', 'resource' => 'servicespage', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('servicespages');
        Schema::dropIfExists('servicespages_translations');
    }
};
