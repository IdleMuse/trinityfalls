<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAptituderanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aptituderanks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('aptitude_id');
            $table->foreign('aptitude_id')->references('id')->on('aptitudes')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('rank');

            $table->text('description')->nullable();

            $table->integer('hhp')->default(0);
            $table->integer('biofocus')->default(0);
            $table->unsignedInteger('bf_cost')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aptituderanks');
    }
}
