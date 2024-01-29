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
        Schema::create('core_users_activity_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url')->nullable();
            $table->string('ip')->nullable();
            $table->string('type')->nullable()->index();
            $table->integer('user_id')->nullable()->index();
            $table->timestamps();
        });
    }
};
