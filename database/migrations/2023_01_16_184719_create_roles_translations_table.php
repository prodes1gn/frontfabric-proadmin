<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('core_roles_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();
            $table->unsignedBigInteger('role_id');
            $table->unique(['role_id', 'locale']);
            $table->foreign('role_id')->references('id')->on('core_roles')->onDelete('cascade');
            $table->string('title');
        });

        Schema::table('core_roles', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
};
