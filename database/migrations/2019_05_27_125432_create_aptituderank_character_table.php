<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAptituderankCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aptituderank_character', function (Blueprint $table) {
            $table->unsignedInteger('aptituderank_id');
            $table->foreign('aptituderank_id')->references('id')->on('aptituderanks')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedInteger('character_id');
            $table->foreign('character_id')->references('id')->on('characters')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(["aptituderank_id", "character_id"]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aptituderank_character');
    }
}
