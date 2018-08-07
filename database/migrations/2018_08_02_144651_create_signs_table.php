<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->text('address')->nullable();
            $table->string('id_card')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('driving_license')->nullable();
            $table->string('oc')->nullable();
            $table->string('nw')->nullable();
            $table->string('pilot_name')->nullable();
            $table->string('pilot_lastname')->nullable();
            $table->text('pilot_address')->nullable();
            $table->string('pilot_id_card')->nullable();
            $table->string('pilot_phone')->nullable();
            $table->string('pilot_email')->nullable();
            $table->string('pilot_driving_license')->nullable();
            $table->string('pilot_oc')->nullable();
            $table->string('pilot_nw')->nullable();
            $table->string('marka')->nullable();
            $table->string('model')->nullable();
            $table->string('turbo')->nullable();
            $table->string('nr_rej')->nullable();
            $table->string('ccm')->nullable();
            $table->string('rok')->nullable();
            $table->string('rwd')->nullable();
            $table->string('klasa');
            $table->boolean('active')->default(1);
            $table->integer('position')->default(0);
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
        Schema::dropIfExists('signs');
    }
}
