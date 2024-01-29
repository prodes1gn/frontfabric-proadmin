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

        Schema::create('aboutuspages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('aboutuspages_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('aboutuspage_id');
            $table->unique(['aboutuspage_id', 'locale'], 'aboutuspage_id_unique');
            $table->foreign('aboutuspage_id', 'aboutuspage_id_foreign')->references('id')->on('aboutuspages')->onDelete('cascade');
        });

        DB::table('aboutuspages')->insert(['id' => 1]);
        DB::table('aboutuspages_translations')->insert(
                [
                    'id' => 1,
                    'locale' => Config::get('translatable.locale'),
                    'name' => 'Aboutuspage',
                    'aboutuspage_id' => 1,
                ]
        );

        DB::table('core_permissions')->insert(['title' => 'aboutuspage_edit']);
        DB::table('core_permissions')->insert(['title' => 'aboutuspage_delete']);
        DB::table('core_permissions')->insert(['title' => 'aboutuspage_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'aboutuspage', 'type' => 'page', 'resource' => 'aboutuspage', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('aboutuspages');
        Schema::dropIfExists('aboutuspages_translations');
    }
};
