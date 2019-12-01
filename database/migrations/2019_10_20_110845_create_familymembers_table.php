<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilymembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familymembers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname', 50);
            $table->string('middlename', 50);
            $table->string('lastname', 50);
            $table->enum('sex', ['female','male']);
            $table->date('birth_date');
            $table->string('memberable_type')->nullable();
            $table->bigInteger('memberable_id')->nullable();
            $table->bigInteger('disability')->unsigned();
            $table->foreign('disability')->references('id')->on('disabilities');
            $table->string('phone_no', 30)->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('relationship')->unsigned();
            $table->foreign('relationship')->references('id')->on('familyrelationships');
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
        Schema::dropIfExists('familymembers');
    }
}
