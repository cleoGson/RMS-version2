<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 80)->unique();
            $table->string('username', 40)->unique();
            $table->string('password')->nullable();
            $table->string('token')->default('token');
            $table->boolean('verifiedstatus')->defeault(1);
            $table->string('userable_type')->nullable();
            $table->string('remeinder')->nullable();
            $table->bigInteger('userable_id')->nullable();
            $table->timestamp('password_changed_at')->nullable();
            $table->string('image')->default('avatar.png');
            $table->bigInteger('status')->default(1);
            $table->bigInteger('center_id')->unsigned()->nullable();
            $table->foreign('center_id')->references('id')->on('centers');
            $table->bigInteger('reseted_by')->unsigned()->nullable();
            $table->foreign('reseted_by')->references('id')->on('users');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->datetime('reseted_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
