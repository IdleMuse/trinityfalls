<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXpdeltasTable extends Migration
{
    public function up()
    {
        Schema::create('xpdeltas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('character_id');
            $table->foreign('character_id')->references('id')->on('characters')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('delta');
            $table->boolean('is_approved')->default(false);

            $table->nullableMorphs('purchaseable');

            $table->string('note')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::dropIfExists('xpdeltas');
    }
}
