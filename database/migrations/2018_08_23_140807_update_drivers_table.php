<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->integer('file_id')->nullable();
            $table->boolean('show_name')->default(1);
            $table->boolean('show_lastname')->default(0);
            $table->boolean('show_email')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn('file_id');
            $table->dropColumn('show_name');
            $table->dropColumn('show_lastname');
            $table->dropColumn('show_email');
        });
    }
}
