<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waves', function (Blueprint $table) {
            $table->string('key');
            $table->primary('key');

            $table->tinyInteger('order');
        });

        DB::table('waves')->insert([
            ['key' => 'first wave', 'order' => 1],
            ['key' => 'second wave', 'order' => 2],
            ['key' => 'third wave', 'order' => 3],
            ['key' => 'final wave', 'order' => 4]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waves');
    }
}
