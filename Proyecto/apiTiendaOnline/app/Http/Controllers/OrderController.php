<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Ramsey\Uuid\Type\Integer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $ordenes = order::where('status', true)->orderBy('id', 'desc')->with(["deliverytype", "orderProducts.product",])->get();
            $response = $ordenes;

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }


    public function all()
    {
        try {

            $order = order::orderBy('id', 'asc')->with(["deliverytype", "orderProducts.product",])->get();
            $response = $order;

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'iv' => 'required|numeric',
            'cost' => 'required|numeric',
            'delivery' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        //para validar si tiene errores
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        DB::beginTransaction();
        try {
            //Instancia orden
            $order = new order();
            //Fecha actual o dada por el usuario depende de la aplicación
            $order->date = Carbon::parse(Carbon::now())->format('Y-m-d H:i:s');
            $order->status = 1;
            $user = auth('api')->user();
            $order->user()->associate($user->id);
            //Guardar encabezado
            $order->IV = $request->input('iv');
            $order->subtotal = $request->input('total');
            $order->sending_cost = $request->input('cost');
            $order->deliverytype_id = $request->input('delivery');

            $order->save();
            //Instancias Detalle orden
            //La siguiente variable debe contener todos los elementos necesarios para registrar el detalle de la orden
            $details = $request->input('details');
            foreach ($details as $item) {
                $order->products()->attach($item['idItem'], [
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    // 'subtotal' => $item['subtotal'],
                ]);
            }

            //SinPersonal de entregas
            if ($request->input('delivery') == 2) {
                $bill = new Bill();
                $bill->user_id = $order->user_id;
                $bill->order_id = $order->id;
                $bill->driver_id = 409654414;
                $bill->status = true;
                $bill->total = $order->subtotal;
                $bill->save();

                $order1 = order::find($order->id);
                $order1->status = 0;
                $order1->save();
            }
            //SinPersonal de entregas

            DB::commit();
            $response = 'Orden creada!';
            return response()->json($response, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $order = order::where('id', $id)->with(["deliverytype", "user", "orderProducts.product",])->first();
            $response = $order;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
