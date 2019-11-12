<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentstudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentstudies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('studentyear_id')->unsigned()->nullable();
            $table->foreign('studentyear_id')->references('id')->on('academicyear_students');
            $table->bigInteger('semester_id')->unsigned()->nullable();
            $table->foreign('semester_id')->references('id')->on('semesters');
            $table->bigInteger('year_id')->unsigned()->nullable();
            $table->foreign('year_id')->references('id')->on('academicyears');
            $table->bigInteger('classsetups_id')->unsigned()->nullable();
            $table->foreign('classsetups_id')->references('id')->on('classsetups');
            $table->bigInteger('studentstatus_id')->unsigned()->nullable();
            $table->foreign('studentstatus_id')->references('id')->on('studentstatuses');
            $table->datetime('reporting_date')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('studentstudies');
    }
}
