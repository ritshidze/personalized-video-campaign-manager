<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Requests\StoreClientRequest;

class ClientController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {

        $client = Client::create($request->all());

        return response()->json($client, 201);    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    
}