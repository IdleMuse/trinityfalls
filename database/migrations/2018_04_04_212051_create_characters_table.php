<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name')->unique();

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');

            $table->string('status');
            $table->foreign('status')->references('key')->on('statuses');

            $table->unsignedSmallInteger('age')->nullable();

            $table->string('wave')->nullable();
            $table->foreign('wave')->references('key')->on('waves');

            $table->longText('description')->nullable();
            $table->longText('background')->nullable();
            $table->longText('ref_notes')->nullable();
            $table->longText('mies')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
