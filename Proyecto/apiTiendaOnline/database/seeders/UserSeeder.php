<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $objetoUsuario = \App\Models\User::create([
            'id' => '40257851',
            'name' => 'Gaby Bolaños',
            'nameUser' => 'Vend',
            'email' => 'gaby@prueba.com',
            'password' => bcrypt('123456'),
            'address' => 'Heredia',
            'phone' => '87451247',
            'rol_id' => 2
        ]);
        $objetoUsuario->save();
        //2
        $objetoUsuario = \App\Models\User::create([
            'id' => '20458251',
            'name' => 'Jose Salas',
            'nameUser' => 'Adm',
            'email' => 'jose@prueba.com',
            'password' => bcrypt('123456'),
            'address' => 'Alajuela',
            'phone' => '87984647',
            'rol_id' => 1
        ]);
        $objetoUsuario->save();
        //3
        $objetoUsuario = \App\Models\User::create([
            'id' => '102547592',
            'name' => 'Ana Jimenez',
            'nameUser' => 'Ana20',
            'email' => 'ana@prueba.com',
            'password' => bcrypt('123456'),
            'address' => 'Alajuela',
            'phone' => '65131247',
            'rol_id' => 3
        ]);
        $objetoUsuario->save();
        //4
        $objetoUsuario = \App\Models\User::create([
            'id' => '302507412',
            'name' => 'Carlos Monge',
            'nameUser' => 'Carlos20',
            'email' => 'carlos@prueba.com',
            'password' => bcrypt('123456'),
            'address' => 'San Jose',
            'phone' => '8745551',
            'rol_id' => 3
        ]);
        $objetoUsuario->save();
        //5
        $objetoUsuario = \App\Models\User::create([
            'id' => '247814365',
            'name' => 'Emmanuel',
            'nameUser' => 'Emma20',
            'email' => 'emma@prueba.com',
            'password' => bcrypt('123456'),
            'address' => 'Cartago',
            'phone' => '64451299',
            'rol_id' => 3
        ]);
        $objetoUsuario->save();
    }
}
