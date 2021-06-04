<?php

namespace App\Http\Controllers;

use App\Models\classification;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $classification = classification::orderBy('id', 'desc')->get();
            $response = $classification;

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
     * @param  \App\Models\classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function show(classification $classification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function edit(classification $classification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, classification $classification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function destroy(classification $classification)
    {
        //
    }
}
