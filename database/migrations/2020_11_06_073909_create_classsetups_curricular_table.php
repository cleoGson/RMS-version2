<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasssetupsCurricularTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classsetups_curricular', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('classsetup_id')->unsigned()->nullable();
            $table->foreign('classsetup_id')->references('id')->on('classsetups');
            $table->bigInteger('curricular_id')->unsigned()->nullable();
            $table->foreign('curricular_id')->references('id')->on('curriculars');
            $table->bigInteger('semester_id')->unsigned()->nullable();
            $table->foreign('semester_id')->references('id')->on('semesters');
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
        Schema::dropIfExists('classsetups_curricular');
    }
}
