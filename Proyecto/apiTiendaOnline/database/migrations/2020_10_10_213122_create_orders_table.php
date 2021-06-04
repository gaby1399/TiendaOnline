6<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateOrdersTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('orders', function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('status');
                $table->decimal('subtotal');
                $table->decimal('sending_cost');
                $table->dateTime('date', 0);
                // $table->dateTime('time', 0);
                $table->decimal('IV');
                $table->timestamps();
                $table->unsignedInteger('deliverytype_id');
                $table->unsignedInteger('user_id');
                $table->foreign('deliverytype_id')->references('id')->on('deliverytypes');
                $table->foreign('user_id')->references('id')->on('users');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropForeign('orders_deliverytype_id_foreign');
            });
            Schema::table('orders', function (Blueprint $table) {
                $table->dropForeign('orders_user_id_foreign');
            });
            Schema::dropIfExists('orders');
        }
    }
