<?php

namespace App\Http\Controllers;

use App\Models\deliverytype;
use Illuminate\Http\Request;

class DeliverytypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $delivery = deliverytype::orderBy('id', 'asc')->get();
            $response = $delivery;

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
     * @param  \App\Models\deliverytype  $deliverytype
     * @return \Illuminate\Http\Response
     */
    public function show(deliverytype $deliverytype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\deliverytype  $deliverytype
     * @return \Illuminate\Http\Response
     */
    public function edit(deliverytype $deliverytype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\deliverytype  $deliverytype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, deliverytype $deliverytype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\deliverytype  $deliverytype
     * @return \Illuminate\Http\Response
     */
    public function destroy(deliverytype $deliverytype)
    {
        //
    }
}
