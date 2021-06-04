<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('category_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('category_product', function (Blueprint $table) {
            $table->dropForeign('category_product_product_id_foreign');
        });
        Schema::table('category_product', function (Blueprint $table) {
            $table->dropForeign('category_product_category_id_foreign');
        });
        Schema::dropIfExists('category_product');
    }
}
