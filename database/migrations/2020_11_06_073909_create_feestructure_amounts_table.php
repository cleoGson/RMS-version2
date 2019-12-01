<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeestructureAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feestructure_amounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('feestructure_id')->unsigned()->nullable();
            $table->foreign('feestructure_id')->references('id')->on('feesstructures');
            $table->bigInteger('feesamount_id')->unsigned()->nullable();
            $table->foreign('feesamount_id')->references('id')->on('feesamounts');
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
        Schema::dropIfExists('feestructure_amounts');
    }
}
