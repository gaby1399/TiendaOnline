<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('driver_id');
            $table->decimal('total');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('driver_id')->references('id')->on('drivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign('bills_driver_id_foreign');
        });
        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign('bills_user_id_foreign');
        });
        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign('bills_order_id_foreign');
        });
        Schema::dropIfExists('bills');
    }
}
