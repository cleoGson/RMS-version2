<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('last_login')->nullable();
            $table->timestamp('last_logout')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('browser')->nullable();
            $table->string('platform_family')->nullable();
            $table->string('device_model')->nullable();
            $table->string('browser_engine')->nullable();
            $table->string('device_family')->nullable();
            $table->string('browser_name')->nullable();
            $table->string('browser_family')->nullable();
            $table->string('platform_name')->nullable();
            $table->string('is_bot')->nullable();
            $table->string('auto_log')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('session_id')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
