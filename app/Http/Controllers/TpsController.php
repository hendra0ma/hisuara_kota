<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use App\Http\Requests\StoreTpsRequest;
use App\Http\Requests\UpdateTpsRequest;

class TpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTpsRequest  $request 
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTpsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function show(Tps $tps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function edit(Tps $tps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTpsRequest  $request
     * @param  \App\Models\Tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTpsRequest $request, Tps $tps)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tps $tps)
    {
        //
    }
}
