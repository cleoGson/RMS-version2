<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGpacurricularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpacurriculars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->enum('status',[0,1])->default(0); //1 locked 0 unlocked
            $table->enum('locked',[0,1])->default(0); //1 locked 0 unlocked
            $table->enum('approved',[0,1])->default(0);
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->bigInteger('year_id')->unsigned()->nullable();
            $table->foreign('year_id')->references('id')->on('academicyears');
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
        Schema::dropIfExists('gpacurriculars');
    }
}
