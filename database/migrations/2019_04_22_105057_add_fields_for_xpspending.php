<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForXpspending extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('downtimepoints', function (Blueprint $table){
            $table->unsignedInteger('xpdelta_id')->nullable()->default(null);
            $table->foreign('xpdelta_id')->references('id')->on('xpdeltas')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('xpdeltas', function (Blueprint $table){
            $table->string('variant')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('downtimepoints', function (Blueprint $table){
            $table->dropForeign('');
            $table->dropColumn('xpdelta_id');
        });

        Schema::table('xpdeltas', function (Blueprint $table){
            $table->dropColumn('variant');
        });
    }
}
