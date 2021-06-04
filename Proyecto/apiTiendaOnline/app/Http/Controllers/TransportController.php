<?php

namespace App\Http\Controllers;

use App\Models\transport;
use Illuminate\Http\Request;


class TransportController extends Controller
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
            $transport = transport::where('status', true)->orderBy('id', 'asc')->with("vehicletype")->get();
            $response = $transport;
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
     * @param  \App\Models\transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function show(transport $transport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(transport $transport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transport $transport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function destroy(transport $transport)
    {
        //
    }
}
