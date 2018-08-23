<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rounds', function (Blueprint $table) {
            $table->integer('max')->default(20);
            $table->dropColumn('termin');
            $table->date('date');
            $table->float('price', 6,2)->nullable();
            $table->float('advance', 6,2)->nullable();
            $table->integer('file_id')->nullable();
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
            $table->dropColumn('max');
            $table->dropColumn('date');
            $table->string('termin');
            $table->dropColumn('price');
            $table->dropColumn('advance');
            $table->dropColumn('file_id');
        });
    }
}
