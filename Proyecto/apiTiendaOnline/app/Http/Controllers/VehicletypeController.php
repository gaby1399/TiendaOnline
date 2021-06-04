<?php

namespace App\Http\Controllers;

use App\Models\vehicletype;
use Illuminate\Http\Request;

class VehicletypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vehicletype = vehicletype::orderBy('id', 'asc')->get();
            $response = $vehicletype;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vehicletype  $vehicletype
     * @return \Illuminate\Http\Response
     */
    public function show(vehicletype $vehicletype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vehicletype  $vehicletype
     * @return \Illuminate\Http\Response
     */
    public function edit(vehicletype $vehicletype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vehicletype  $vehicletype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vehicletype $vehicletype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vehicletype  $vehicletype
     * @return \Illuminate\Http\Response
     */
    public function destroy(vehicletype $vehicletype)
    {
        //
    }
}
