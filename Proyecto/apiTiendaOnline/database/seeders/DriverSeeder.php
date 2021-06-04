<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $driver = new \App\Models\Driver();
        $driver->id = 401580365;
        $driver->name = 'Isaac Herrera';
        $driver->phone = '87143596';
        $driver->status = true;
        $driver->transport_id = 1;
        $driver->save();

        $driver = new \App\Models\Driver();
        $driver->id = 309650412;
        $driver->name = 'Jazmin Piedra';
        $driver->phone = '87143596';
        $driver->status = true;
        $driver->transport_id = 2;
        $driver->save();

        $driver = new \App\Models\Driver();
        $driver->id = 209025112;
        $driver->name = 'Isabela Soto';
        $driver->phone = '65234897';
        $driver->status = false;
        $driver->transport_id = 3;
        $driver->save();

        $driver = new \App\Models\Driver();
        $driver->id = 409654413;
        $driver->name = 'Daniel Alvarado';
        $driver->phone = '84157265';
        $driver->status = true;
        $driver->transport_id = 4;
        $driver->save();

        $driver = new \App\Models\Driver();
        $driver->id = 102540369;
        $driver->name = 'Aurora Chaves';
        $driver->phone = '87842536';
        $driver->status = true;
        $driver->transport_id = 1;
        $driver->save();

        $driver = new \App\Models\Driver();
        $driver->id = 301457896;
        $driver->name = 'Marco Arroyo';
        $driver->phone = '62050014';
        $driver->status = false;
        $driver->transport_id = 3;
        $driver->save();

        $driver = new \App\Models\Driver();
        $driver->id = 00001;
        $driver->name = 'No aplica';
        $driver->phone = '00000000';
        $driver->status = true;
        $driver->transport_id = 3;
        $driver->save();
    }
}
