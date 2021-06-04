<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $bill = Bill::where('status', true)->orderBy('id', 'desc')->with(["user", "driver", "order"])->get();
            $response = $bill;

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
            'userId' => 'required|numeric',
            'orderId' => 'required|numeric',
            'driver' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        //para validar si tiene errores
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        DB::beginTransaction();
        try {
            //Crear la instancia
            $bill = new Bill();
            $bill->user_id = $request->input('userId');
            $bill->order_id = $request->input('orderId');
            $bill->driver_id = $request->input('driver');
            $bill->status = true;
            $bill->total = $request->input('total');


            $bill->save();

            $id = $request->input('orderId');

            $order = order::find($id);
            $order->status = 0;
            $order->save();

            DB::commit();
            $response = 'Facturas creada!';
            return response()->json($response, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bills  $bills
     * @return \Illuminate\Http\Response
     */
    public function show(Bills $bills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bills  $bills
     * @return \Illuminate\Http\Response
     */
    public function edit(Bills $bills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bills  $bills
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state' => 'required|numeric',
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        try {

            $bill = Bill::find($request->input('id'));
            $bill->status = $request->input('state');
            $bill->save();
        } catch (\Exception $e) {
            return response()->json($validator->messages(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bills  $bills
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bills $bills)
    {
        //
    }
}
