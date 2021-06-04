<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->decimal('price');
            $table->integer('quantity');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropForeign('order_products_order_id_foreign');
        });
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropForeign('order_product_product_id_foreign');
        });
        Schema::dropIfExists('order_products');
    }
}
