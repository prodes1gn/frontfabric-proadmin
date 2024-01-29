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

        Schema::create('contactspages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('contactspages_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('contactspage_id');
            $table->unique(['contactspage_id', 'locale'], 'contactspage_id_unique');
            $table->foreign('contactspage_id', 'contactspage_id_foreign')->references('id')->on('contactspages')->onDelete('cascade');
        });

        DB::table('contactspages')->insert(['id' => 1]);
        DB::table('contactspages_translations')->insert(
                [
                    'id' => 1,
                    'locale' => Config::get('translatable.locale'),
                    'name' => 'Contactspage',
                    'contactspage_id' => 1,
                ]
        );

        DB::table('core_permissions')->insert(['title' => 'contactspage_edit']);
        DB::table('core_permissions')->insert(['title' => 'contactspage_delete']);
        DB::table('core_permissions')->insert(['title' => 'contactspage_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'contactspage', 'type' => 'page', 'resource' => 'contactspage', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contactspages');
        Schema::dropIfExists('contactspages_translations');
    }
};
