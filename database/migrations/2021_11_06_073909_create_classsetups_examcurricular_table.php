<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasssetupsExamcurricularTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('classsetups_examcurricular', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('classsetup_id')->unsigned()->nullable();
            $table->foreign('classsetup_id')->references('id')->on('classsetups');
            $table->bigInteger('examcurricular_id')->unsigned()->nullable();
            $table->foreign('examcurricular_id')->references('id')->on('examinationcurriculars');
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
        Schema::dropIfExists('classsetups_examcurricular');
    }
}
