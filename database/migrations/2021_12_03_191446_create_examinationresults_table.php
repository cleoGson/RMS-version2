<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinationresults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')->on('classrooms');
            $table->bigInteger('classsection_id')->unsigned()->nullable();
            $table->foreign('classsection_id')->references('id')->on('classrooms');
            $table->bigInteger('academicyear_student_id')->unsigned()->nullable();
            $table->foreign('academicyear_student_id')->references('id')->on('academicyear_students');
            $table->bigInteger('examinationtype_id')->unsigned()->nullable();
            $table->foreign('examinationtype_id')->references('id')->on('examinationtypes');
            $table->bigInteger('semester_id')->unsigned()->nullable();
            $table->foreign('semester_id')->references('id')->on('semesters');
            $table->bigInteger('year_id')->unsigned()->nullable();
            $table->foreign('year_id')->references('id')->on('academicyears');
            $table->bigInteger('subject_id')->unsigned()->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->bigInteger('examination_nature')->unsigned()->nullable();
            $table->foreign('examination_nature')->references('id')->on('examinationnatures');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->double('marks')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('status',['A','N'])->default('A');
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
        Schema::dropIfExists('examinationresults');
    }
}
