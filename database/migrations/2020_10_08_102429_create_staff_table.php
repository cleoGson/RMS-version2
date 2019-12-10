<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname', 50);
            $table->string('middlename', 50);
            $table->string('lastname', 50);
            $table->enum('sex', ['female','male']);
            $table->bigInteger('marital_status')->unsigned()->nullable();
            $table->foreign('marital_status')->references('id')->on('maritals');
            $table->date('birth_date');
            $table->string('disability',32)->nullable();
            $table->string('birth_place', 120);
            $table->string('email')->unique();
            $table->text('address')->nullable();
            $table->string('phone_no', 13)->nullable();
            $table->string('check_no', 50)->nullable();
            $table->string('staff_number', 50)->nullable();
            $table->bigInteger('birth_country')->unsigned()->nullable();
            $table->foreign('birth_country')->references('id')->on('countries');
            $table->bigInteger('citzenship')->unsigned()->nullable();
            $table->foreign('citzenship')->references('id')->on('countries');           
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->bigInteger('designation_id')->unsigned()->nullable();
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->bigInteger('created_by')->unsigned()->nullable();
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
        Schema::dropIfExists('staff');
    }
}
