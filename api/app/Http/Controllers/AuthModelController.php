<?php

namespace App\Http\Controllers;

use App\Models\AuthModel;
use App\Http\Requests\StoreAuthModelRequest;
use App\Http\Requests\UpdateAuthModelRequest;

class AuthModelController extends Controller
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
     * @param  \App\Http\Requests\StoreAuthModelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthModelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AuthModel  $authModel
     * @return \Illuminate\Http\Response
     */
    public function show(AuthModel $authModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuthModel  $authModel
     * @return \Illuminate\Http\Response
     */
    public function edit(AuthModel $authModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthModelRequest  $request
     * @param  \App\Models\AuthModel  $authModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthModelRequest $request, AuthModel $authModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuthModel  $authModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuthModel $authModel)
    {
        //
    }
}
