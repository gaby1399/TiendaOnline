<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $order = new \App\Models\order();
        $order->subtotal = 76000;
        $order->sending_cost = 2500;
        $order->date = new DateTime('2020-10-22');
        $order->status = true;
        $order->IV = 800;
        $order->user_id = 40257851;
        $order->deliverytype_id = 1;
        $order->save();

        $detalle1 = new \App\Models\OrderProduct();
        $detalle1->order_id = $order->id;
        $detalle1->quantity = 1;
        $detalle1->product_id = 1;
        $detalle1->price = 60000;
        $detalle1->save();

        $detalle2 = new \App\Models\OrderProduct();
        $detalle2->order_id = $order->id;
        $detalle2->quantity = 2;
        $detalle2->product_id = 4;
        $detalle2->price = 16000;
        $detalle2->save();


        //2
        $order = new \App\Models\order();
        $order->subtotal = 90000;
        $order->sending_cost = 2500;
        $order->date = new DateTime('2020-10-23');
        $order->status = true;
        $order->IV = 800;
        $order->user_id = 40257851;
        $order->deliverytype_id = 2;
        $order->save();

        $detalle1 = new \App\Models\OrderProduct();
        $detalle1->order_id = $order->id;
        $detalle1->quantity = 1;
        $detalle1->product_id = 1;
        $detalle1->price = 60000;
        $detalle1->save();

        $detalle2 = new \App\Models\OrderProduct();
        $detalle2->order_id = $order->id;
        $detalle2->quantity = 1;
        $detalle2->product_id = 5;
        $detalle2->price = 30000;
        $detalle2->save();

        //3
        $order = new \App\Models\order();
        $order->subtotal = 520000;
        $order->sending_cost = 3500;
        $order->date = new DateTime('2020-10-27');
        $order->status = true;
        $order->IV = 800;
        $order->user_id = 40257851;
        $order->deliverytype_id = 2;
        $order->save();

        $detalle1 = new \App\Models\OrderProduct();
        $detalle1->order_id = $order->id;
        $detalle1->quantity = 2;
        $detalle1->product_id = 2;
        $detalle1->price = 520000;
        $detalle1->save();

        //4
        $order = new \App\Models\order();
        $order->subtotal = 160000;
        $order->sending_cost = 2500;
        $order->date = new DateTime('2020-10-25');
        $order->status = true;
        $order->IV = 800;
        $order->user_id = 20458251;
        $order->deliverytype_id = 2;
        $order->save();

        $detalle1 = new \App\Models\OrderProduct();
        $detalle1->order_id = $order->id;
        $detalle1->quantity = 1;
        $detalle1->product_id = 6;
        $detalle1->price = 60000;
        $detalle1->save();

        $detalle2 = new \App\Models\OrderProduct();
        $detalle2->order_id = $order->id;
        $detalle2->quantity = 4;
        $detalle2->product_id = 3;
        $detalle2->price = 100000;
        $detalle2->save();

        //5
        $order = new \App\Models\order();
        $order->subtotal = 180000;
        $order->sending_cost = 2500;
        $order->date = new DateTime('2020-10-26');
        $order->status = true;
        $order->IV = 800;
        $order->user_id = 20458251;
        $order->deliverytype_id = 2;
        $order->save();

        $detalle1 = new \App\Models\OrderProduct();
        $detalle1->order_id = $order->id;
        $detalle1->quantity = 3;
        $detalle1->product_id = 1;
        $detalle1->price = 180000;
        $detalle1->save();
    }
}
