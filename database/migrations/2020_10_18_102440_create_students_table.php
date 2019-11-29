<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->enum('sex', ['female','male'])->default('male');
            $table->bigInteger('marital_status')->unsigned()->nullable();
            $table->foreign('marital_status')->references('id')->on('maritals');
            $table->date('birth_date');
            $table->bigInteger('disability')->unsigned()->nullable();
            $table->foreign('disability')->references('id')->on('disabilities');
            $table->string('birth_place', 120);
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('photo')->nullable();
            $table->bigInteger('blood_group')->unsigned()->nullable();
            $table->foreign('blood_group')->references('id')->on('bloodgroups');
            $table->string('phone_no', 13)->nullable();
            $table->string('student_number')->unique();
            $table->bigInteger('birth_country')->unsigned();
            $table->foreign('birth_country')->references('id')->on('countries');
            $table->bigInteger('citzenship')->unsigned();
            $table->foreign('citzenship')->references('id')->on('countries');           
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');           
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('students');
    }
}
