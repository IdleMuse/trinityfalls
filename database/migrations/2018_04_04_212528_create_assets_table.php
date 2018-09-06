<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('asset_type');
            $table->foreign('asset_type')->references('key')->on('assettypes')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedInteger('asset_id');

            $table->string('name');

            $table->unsignedInteger('faction_id');
            $table->foreign('faction_id')->references('id')->on('factions')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
