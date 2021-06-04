<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transport = new \App\Models\transport();

        $transport->model = 'Coroya';
        $transport->brand = 'Toyota';
        $transport->status = true;
        $transport->vehicletype_id = 3;
        $transport->save();

        $transport = new \App\Models\transport();

        $transport->model = '2019';
        $transport->brand = 'Scott';
        $transport->status = true;
        $transport->vehicletype_id = 2;
        $transport->save();

        $transport = new \App\Models\transport();

        $transport->model = 'ybr125';
        $transport->brand = 'Yamaha';
        $transport->status = false;
        $transport->vehicletype_id = 1;
        $transport->save();

        $transport = new \App\Models\transport();

        $transport->model = 'Juke';
        $transport->brand = 'nissan';
        $transport->status = false;
        $transport->vehicletype_id = 3;
        $transport->save();

        $transport = new \App\Models\transport();

        $transport->model = '2017';
        $transport->brand = 'Scott';
        $transport->status = true;
        $transport->vehicletype_id = 2;
        $transport->save();

        $transport = new \App\Models\transport();

        $transport->model = 'ybr150';
        $transport->brand = 'Yamaha';
        $transport->status = false;
        $transport->vehicletype_id = 1;
        $transport->save();

        $transport = new \App\Models\transport();

        $transport->model = 'Echo';
        $transport->brand = 'Toyota';
        $transport->status = false;
        $transport->vehicletype_id = 2;
        $transport->save();
    }
}
