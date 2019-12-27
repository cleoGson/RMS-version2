<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGpacurricularGparangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpacurricular_gparanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('gpacurricular_id')->unsigned()->nullable();
            $table->foreign('gpacurricular_id')->references('id')->on('gpacurriculars');
            $table->bigInteger('gparange_id')->unsigned()->nullable();
            $table->foreign('gparange_id')->references('id')->on('gparanges');
            $table->enum('status',[0,1])->default(0); //1 compusory 0 optional
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
