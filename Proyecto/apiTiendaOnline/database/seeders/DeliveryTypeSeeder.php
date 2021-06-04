<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeliveryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $delivery = new \App\Models\deliverytype();

        $delivery->description = 'Domicilio';
        $delivery->save();

        $delivery = new \App\Models\deliverytype();

        $delivery->description = 'Presencial';
        $delivery->save();
    }
}
