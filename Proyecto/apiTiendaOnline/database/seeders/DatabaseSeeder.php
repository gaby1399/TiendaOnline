<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ClassificationSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(VehicletypeSeeder::class);
        $this->call(TransportSeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(DeliveryTypeSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(BillSeeder::class);
    }
}
