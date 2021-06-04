<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicletypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicle = new \App\Models\vehicletype();

        $vehicle->type = 'Motcicleta';
        $vehicle->save();

        $vehicle = new \App\Models\vehicletype();

        $vehicle->type = 'Bicicleta';
        $vehicle->save();

        $vehicle = new \App\Models\vehicletype();

        $vehicle->type = 'Automovil';
        $vehicle->save();
    }
}
