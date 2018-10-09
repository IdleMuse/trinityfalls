<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDowntimeperiodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downtimeperiods', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->datetime('opens_at');
            $table->datetime('closes_at');
            $table->datetime('releases_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('downtimeperiods');
    }
}
