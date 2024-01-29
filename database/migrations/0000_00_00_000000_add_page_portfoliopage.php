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

        Schema::create('portfoliopages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('portfoliopages_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('portfoliopage_id');
            $table->unique(['portfoliopage_id', 'locale'], 'portfoliopage_id_unique');
            $table->foreign('portfoliopage_id', 'portfoliopage_id_foreign')->references('id')->on('portfoliopages')->onDelete('cascade');
        });

        DB::table('portfoliopages')->insert(['id' => 1]);
        DB::table('portfoliopages_translations')->insert(
                [
                    'id' => 1,
                    'locale' => Config::get('translatable.locale'),
                    'name' => 'Portfoliopage',
                    'portfoliopage_id' => 1,
                ]
        );

        DB::table('core_permissions')->insert(['title' => 'portfoliopage_edit']);
        DB::table('core_permissions')->insert(['title' => 'portfoliopage_delete']);
        DB::table('core_permissions')->insert(['title' => 'portfoliopage_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'portfoliopage', 'type' => 'page', 'resource' => 'portfoliopage', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('portfoliopages');
        Schema::dropIfExists('portfoliopages_translations');
    }
};
