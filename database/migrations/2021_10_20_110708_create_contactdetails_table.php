<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address', 50)->nullable();
            $table->string('phone_no', 13)->nullable();
            $table->string('email')->nullable();
            $table->string('fax_number', 20)->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('contactable_type')->nullable();
            $table->bigInteger('contactable_id')->nullable();
            $table->string('github_link')->nullable();
            $table->string('website_link')->nullable();
            $table->string('twitter')->nullable();
            $table->string('slack_channel')->nullable();
            $table->string('discord_channel')->nullable();
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
        Schema::dropIfExists('contactdetails');
    }
}
