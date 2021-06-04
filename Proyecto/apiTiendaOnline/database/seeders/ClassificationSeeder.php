<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classification = new \App\Models\Classification();

        $classification->description = 'Camara';
        $classification->save();

        $classification = new \App\Models\Classification();

        $classification->description = 'Portero';
        $classification->save();

        $classification = new \App\Models\Classification();

        $classification->description = 'Cerradura';
        $classification->save();

        $classification = new \App\Models\Classification();

        $classification->description = 'Pantalla';
        $classification->save();

        $classification = new \App\Models\Classification();

        $classification->description = 'Luz';
        $classification->save();
    }
}
