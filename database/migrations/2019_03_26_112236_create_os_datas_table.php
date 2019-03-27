<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOsDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('os_id')->unsigned();
            $table->integer('sign_id')->unsigned();
            $table->string('netto')->nullable();
            $table->string('penalty')->nullable();
            $table->string('brutto')->nullable();
            $table->string('leading_lose')->nullable();
            $table->string('next_lose')->nullable();
            $table->float('netto_s',8,2)->nullable();
            $table->float('penalty_s',8,2)->nullable();
            $table->float('brutto_s',8,2)->nullable();
            $table->float('leading_lose_s',8,2)->nullable();
            $table->string('klasa')->nullable();
            $table->float('reaction',5,2)->nullable();
            $table->float('speed',5,2)->nullable();
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
        Schema::dropIfExists('os_datas');
    }
}
