<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationcurricularExammarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinationcurricular_exammarks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('examinationcurricular_id')->unsigned()->nullable();
            $table->foreign('examinationcurricular_id')->references('id')->on('examinationcurriculars');
            $table->bigInteger('examinationmark_id')->unsigned()->nullable();
            $table->foreign('examinationmark_id')->references('id')->on('examinationmarks');
            $table->enum('status',[1,0])->default(1); //1 compusory 0 optional
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
        Schema::dropIfExists('examinationcurricular_exammarks');
    }
}
