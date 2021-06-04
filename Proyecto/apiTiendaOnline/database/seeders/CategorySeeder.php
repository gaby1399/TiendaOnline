<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Models\Category();
        $category->description = 'Seguridad';
        $category->save();

        $category = new \App\Models\Category();

        $category->description = 'Electrodomesticos';
        $category->save();

        $category = new \App\Models\Category();

        $category->description = 'Control';
        $category->save();

        $category = new \App\Models\Category();

        $category->description = 'Entretenimiento';
        $category->save();
    }
}
