<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bill = new \App\Models\Bill();
        $bill->id = 1;
        $bill->total = 78500;
        $bill->status = true;
        $bill->user_id = 40257851;
        $bill->order_id = 1;
        $bill->driver_id = 309650412;
        $bill->save();

        $bill = new \App\Models\Bill();
        $bill->id = 2;
        $bill->total = 92500;
        $bill->status = true;
        $bill->user_id = 20458251;
        $bill->order_id = 2;
        $bill->driver_id = 401580365;
        $bill->save();
    }
}
