<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model');
            $table->string('brand');
            $table->boolean('status');
            $table->timestamps();
            $table->unsignedInteger('vehicletype_id');
            $table->foreign('vehicletype_id')->references('id')->on('vehicletypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transports', function (Blueprint $table) {
            $table->dropForeign('transports_vehicletype_id_foreign');
        });
        Schema::dropIfExists('transports');
    }
}
