<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //Listar los productos
            $product = Product::where('state', true)->orderBy('description', 'asc')->with(['categories', 'classification'])->get();
            $response = $product;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function all()
    {
        try {
            /*  Listado de videojuegos
           incluyendo los generos que tiene asignados
           y la información del usuario
            */
            $product = Product::orderBy('description', 'asc')->with(["classification", "categories"])->get();
            $response = $product;

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|min:5',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'state' => 'required',
            'classification' => 'required',
            //AQUI se puede validar diferentes requisitos en la imagen
        ]);

        //para validar si tiene errores
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        try {
            //Crear la instancia
            $prod = new Product();
            $prod->description = $request->input('description');
            $prod->quantity = $request->input('quantity');
            $prod->price = $request->input('price');
            $prod->state = $request->input('state');
            $prod->classification_id = $request->input('classification');

            //imagen
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $nameImage = time() . "foto." . $file->getClientOriginalExtension();
                $imageUpload = Image::make($file->getRealPath()); //toma la imagen
                $path = 'images/'; //la dirección donde se va a guardar
                $imageUpload->save(public_path($path) . $nameImage);
                //la guarda segun la direccion y el nombre dado a la imagen
                $prod->image = url($path) . "/" . $nameImage;
            } else {
                $prod->image = ' ';
            }
            //guardar
            if ($prod->save()) {
                //asociar otras tablas
                $category = $request->input('category_id');
                if (!is_array($request->input('category_id'))) {
                    //Formato array relación muchos a muchos
                    $category = explode(',', $request->input('category_id'));
                }
                if (!is_null($request->input('category_id'))) {
                    $prod->categories()->attach($category);
                }

                $response = 'Se ha creado el producto con exito';
                return response()->json($response, 200);
            } else {
                $response = 'Se ha produccido un error al crear el producto';
                return response()->json($response, 404);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            //Obtener un producto
            $product = Product::where('id', $id)->with(["classification", "categories"])->first();
            $response = $product;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'description' => 'required|min:5',
                'quantity' => 'required|numeric',
                'price' => 'required|numeric',
                'state' => 'required',
                'classification' => 'required',
            ]
        );
        //para validar si tiene errores
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $prod = Product::find($id);
        $prod->description = $request->input('description');
        $prod->quantity = $request->input('quantity');
        $prod->price = $request->input('price');
        $prod->state = $request->input('state');
        $prod->classification_id = $request->input('classification');

        //imagen
        if ($request->hasFile('image')) {

            //REVISAR SI FUNCIONA
            //Borrar la imagen anterior
            //Obtener archivo de imagen anterior
            $img = $prod->image;
            if (File::exists($img)) {
                //Borrar imagen anterior
                File::delete($img);
            }

            $file = $request->file('image');
            $nameImage = time() . "foto." . $file->getClientOriginalExtension();
            $imageUpload = Image::make($file->getRealPath()); //toma la imagen
            $path = 'images/'; //la dirección donde se va a guardar
            $imageUpload->save(public_path($path) . $nameImage);
            //la guarda segun la direccion y el nombre dado a la imagen
            $prod->image = url($path) . "/" . $nameImage;
        }

        if ($prod->update()) {
            //Sincronice categorias
            if (!is_array($request->input('category_id'))) {
                //Crea una string separada por , en un array
                $category =
                    explode(',', $request->input('category_id'));
            }
            if (!is_null($request->input('category_id'))) {

                $prod->categories()->sync($category);
            }

            $response = 'Se ha actualizado el producto!';
            return response()->json($response, 200);
        }
        $response = [
            'msg' => 'Error durante la actualización'
        ];

        return response()->json($response, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
}
