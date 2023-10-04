<?php

namespace App\Http\Controllers;

use App\Models\Databukti;
use App\Http\Requests\StoreDatabuktiRequest;
use App\Http\Requests\UpdateDatabuktiRequest;

class DatabuktiController extends Controller
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
     * @param  \App\Http\Requests\StoreDatabuktiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDatabuktiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Databukti  $databukti
     * @return \Illuminate\Http\Response
     */
    public function show(Databukti $databukti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Databukti  $databukti
     * @return \Illuminate\Http\Response
     */
    public function edit(Databukti $databukti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDatabuktiRequest  $request
     * @param  \App\Models\Databukti  $databukti
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDatabuktiRequest $request, Databukti $databukti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Databukti  $databukti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Databukti $databukti)
    {
        //
    }
}
