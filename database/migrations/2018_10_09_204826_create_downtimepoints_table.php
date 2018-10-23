<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDowntimepointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downtimepoints', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('downtime_id');
            $table->foreign('downtime_id')->references('id')->on('downtimes')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedInteger('order');
            $table->unique(['downtime_id', 'order']);

            $table->text('text')->nullable();
            $table->text('response')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('downtimepoints');
    }
}
