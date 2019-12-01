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
            $table->string('name')->nullable();
            $table->bigInteger('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')->on('classrooms');
            $table->bigInteger('classsection_id')->unsigned()->nullable();
            $table->foreign('classsection_id')->references('id')->on('classsections');
            $table->bigInteger('grade_curricular')->unsigned()->nullable();
            $table->foreign('grade_curricular')->references('id')->on('gradecurriculars');
            $table->bigInteger('curricular_id')->unsigned()->nullable();
            $table->foreign('curricular_id')->references('id')->on('curriculars');
            $table->bigInteger('feesstructure_id')->unsigned()->nullable();
            $table->foreign('feesstructure_id')->references('id')->on('feesstructures');
            $table->double('minimum_capacity')->default(0);
            $table->double('maximum_capacity')->default(0);
            $table->bigInteger('year_id')->unsigned()->nullable();
            $table->foreign('year_id')->references('id')->on('academicyears');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->enum('status',[1,0])->default(1);
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
