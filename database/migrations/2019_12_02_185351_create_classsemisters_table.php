<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasssemistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classsemisters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_academic_year_id')->unsigned()->nullable();
            $table->foreign('student_academic_year_id')->references('id')->on('academicyear_students');
            $table->bigInteger('year_id')->unsigned()->nullable();
            $table->foreign('year_id')->references('id')->on('academicyears');
            $table->bigInteger('studentstatus_id')->unsigned()->nullable();
            $table->foreign('studentstatus_id')->references('id')->on('studentstatuses');
            $table->bigInteger('semister_id')->unsigned()->nullable();
            $table->foreign('semister_id')->references('id')->on('semesters');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->datetime('date')->nullable();
            $table->longText('remarks')->nullable();
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
        Schema::dropIfExists('classsemisters');
    }
}
