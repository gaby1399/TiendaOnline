<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Models\Product();

        $product->description = 'Cerradura';
        $product->quantity = 25;
        $product->price = 60000;
        $product->state = true;
        $product->image = 'http://127.0.0.1:8000/images/cerradura.jpg';
        $product->classification_id = 3;
        $product->save();
        $product->categories()->attach([3, 1]);
        $product = new \App\Models\Product();

        $product->description = 'Pantallas tactil';
        $product->quantity = 10;
        $product->price = 260000;
        $product->state = true;
        $product->image = 'http://127.0.0.1:8000/images/pantalla.jpg';
        $product->classification_id = 4;
        $product->save();
        $product->categories()->attach([2, 4]);


        $product = new \App\Models\Product();

        $product->description = 'Camaras';
        $product->quantity = 55;
        $product->price = 25000;
        $product->state = true;
        $product->image = 'http://127.0.0.1:8000/images/camaras-wifi.jpg';
        $product->classification_id = 1;
        $product->save();
        $product->categories()->attach([3, 1]);


        $product = new \App\Models\Product();

        $product->description = 'Bombillo  luz wifi';
        $product->quantity = 20;
        $product->price = 8000;
        $product->state = true;
        $product->image = 'http://127.0.0.1:8000/images/bombilla-inteligente.jpg';
        $product->classification_id = 5;
        $product->save();
        $product->categories()->attach([4, 3]);


        $product = new \App\Models\Product();

        $product->description = 'Video Portero Inalámbrico';
        $product->quantity = 20;
        $product->price = 30000;
        $product->state = true;
        $product->image = 'http://127.0.0.1:8000/images/portero.jpg';
        $product->classification_id = 2;
        $product->save();
        $product->categories()->attach([2, 1]);


        $product = new \App\Models\Product();
        $product->description = 'Vídeo portero para exteriores pantalla';
        $product->quantity = 15;
        $product->price = 60000;
        $product->state = true;
        $product->image = 'http://127.0.0.1:8000/images/videoPortero.jpg';
        $product->classification_id = 2;
        $product->save();
        $product->categories()->attach([3, 1]);
    }
}
