<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRoundsTable7 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rounds', function (Blueprint $table) {
            $table->text('desc')->nullable();
            $table->text('serwis')->nullable();
            $table->string('length')->nullable();
            $table->string('special_length')->nullable();
            $table->string('driveway_length')->nullable();
            $table->integer('poster_id')->nullable();
            $table->integer('map_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rounds', function (Blueprint $table) {
            $table->dropColumn('details');
        });
    }
}
