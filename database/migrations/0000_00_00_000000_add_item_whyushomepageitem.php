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

        Schema::create('whyushomepageitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('whyushomepageitems_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index('locale');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('whyushomepageitem_id');
            $table->unique(['whyushomepageitem_id', 'locale'], 'whyushomepageitem_id_unique');
            $table->foreign('whyushomepageitem_id', 'whyushomepageitem_id_foreign')->references('id')->on('whyushomepageitems')->onDelete('cascade');
        });

        DB::table('core_permissions')->insert(['title' => 'whyushomepageitem_create']);
        DB::table('core_permissions')->insert(['title' => 'whyushomepageitem_edit']);
        DB::table('core_permissions')->insert(['title' => 'whyushomepageitem_show']);
        DB::table('core_permissions')->insert(['title' => 'whyushomepageitem_delete']);
        DB::table('core_permissions')->insert(['title' => 'whyushomepageitem_access']);

        DB::table('dev_generators')->insert(
                ['name' => 'whyushomepageitem', 'type' => 'item', 'resource' => 'whyushomepageitem', 'resource_type' => '', 'resource_type_name' => ''],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('whyushomepageitems');
        Schema::dropIfExists('whyushomepageitems_translations');
    }
};
