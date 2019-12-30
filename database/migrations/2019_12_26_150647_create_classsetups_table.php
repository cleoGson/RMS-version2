<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasssetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classsetups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')->on('classrooms');
            $table->bigInteger('grade_curricular')->unsigned()->nullable();
            $table->foreign('grade_curricular')->references('id')->on('gradecurriculars');
            $table->bigInteger('fees_structure')->unsigned()->nullable();
            $table->foreign('fees_structure')->references('id')->on('feesstructures');
            $table->double('minimum_capacity')->default(0);
            $table->double('maximum_capacity')->default(0);
            $table->bigInteger('year_id')->unsigned()->nullable();
            $table->foreign('year_id')->references('id')->on('academicyears');
            $table->bigInteger('gpa_curricular')->unsigned()->nullable();
            $table->foreign('gpa_curricular')->references('id')->on('gpacurriculars');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
            $table->enum('status',[1,0])->default(1);
            $table->enum('approved',[1,0])->default(1);
            $table->enum('locked',[0,1])->default(0);
            $table->enum('result_system',[2,1])->default(2);
            $table->enum('gpa_applicable',[1,0])->default(0);
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
        Schema::dropIfExists('classsetups');
    }
}
