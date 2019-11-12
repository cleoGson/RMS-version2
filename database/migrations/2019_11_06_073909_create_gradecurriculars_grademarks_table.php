<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradecurricularsGrademarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradecurriculars_grademarks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('gradecurricular_id')->unsigned()->nullable();
            $table->foreign('gradecurricular_id')->references('id')->on('gradecurriculars');
            $table->bigInteger('grademark_id')->unsigned()->nullable();
            $table->foreign('grademark_id')->references('id')->on('grademarks');
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
        Schema::dropIfExists('gradecurriculars_grademarks');
    }
}
