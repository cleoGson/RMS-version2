<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionalSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('optional_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('academicyear_student_id')->unsigned()->nullable();
            $table->foreign('academicyear_student_id')->references('id')->on('academicyear_students');
            $table->bigInteger('subject_id')->unsigned()->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->bigInteger('semester_id')->unsigned()->nullable();
            $table->foreign('semester_id')->references('id')->on('semesters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('optional_subjects');
    }
}
