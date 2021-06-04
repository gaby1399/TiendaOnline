<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Drivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $driver = Driver::where('status', true)->orderBy('id', 'asc')->with("transport.vehicletype")->get();
            $response = $driver;

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
    //guardar el recurso en la bd
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric',
            'transport_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 442);
        }
        try {
            //instancia
            $dri = new Driver();
            $dri->id = $request->input('id');
            $dri->name = $request->input('name');
            $dri->phone = $request->input('phone');
            $dri->transport_id = $request->input('transport_id');
            $dri->status = 1;
            //$user = auth('api')->user();
            // $dri->user()->associate($user->id);
            //guardar
            if ($dri->save()) {
                $response = 'Conductor creado';
                return response()->json($response, 201);
            } else {
                $response = 'Error durante la creación';
                return response()->json($response, 404);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function all()
    {
        try {

            $driver = Driver::orderBy('id', 'asc')->with("transport.vehicletype")->get();
            $response = $driver;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $driver = Driver::where('id', $id)->with("transport.vehicletype")->first();
            $response = $driver;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'phone' => 'required|numeric',
            'transport_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $driver = Driver::find($id);
        $driver->name = $request->input('name');
        $driver->phone = $request->input('phone');
        $driver->transport_id = $request->input('transport_id');

        if ($driver->update()) {
            $response = 'Conductor guardado!';
            return response()->json($response, 200);
        }
        $response = ['msg' => 'Error durante la actulización'];
    }

    public function updateState(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state' => 'required|numeric',
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        try {
            $driver = Driver::find($request->input('id'));
            $driver->status = $request->input('state');
            $driver->save();
        } catch (\Exception $e) {
            return response()->json($validator->messages(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drivers $drivers)
    {
        //
    }
}
