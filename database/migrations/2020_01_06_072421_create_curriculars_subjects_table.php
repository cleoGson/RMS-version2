<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurricularsSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculars_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('curricular_id')->unsigned()->nullable();
            $table->foreign('curricular_id')->references('id')->on('curriculars');
            $table->bigInteger('subject_id')->unsigned()->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->enum('status',[1,0])->default(1); //1 compusory 0 optional
             $table->enum('locked',[0,1])->default(0); 
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
        Schema::dropIfExists('curriculars_subjects');
    }
}
