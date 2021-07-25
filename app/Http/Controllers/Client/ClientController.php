<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\ApiController;
use App\Models\Client;
use App\Transformers\ClientTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class ClientController extends ApiController
{
    public function __construct()
    {
        parent:: __construct();
        $this->middleware('transform.input:' . ClientTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return  $this->showAll($clients);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'email|required|unique:clients',
            'phone' => 'required|min:10',
            'address' => 'required',
            'pincode' => 'required',
            'description' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $client = Client::create($data);

        return $this->showOne($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return $this->showOne($client);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $rules = [
            'email' => 'email|unique:clients,email,'. $client->id,
            'phone' => 'min:10',
            'status' => 'in:'. Client::ACTIVE_CLIENT .','. Client::INACTIVE_CLIENT,
        ];

        $this->validate($request, $rules);

        if ($request->has('name')) {
            $client->name = $request->name;
        }

        if ($request->has('email')) {
            $client->email = $request->email;
        }

        if ($request->has('phone')) {
            $client->phone = $request->phone;
        }

        if ($request->has('address')) {
            $client->address = $request->address;
        }

        if ($request->has('pincode')) {
            $client->pincode = $request->pincode;
        }

        if ($request->has('status')) {
            $client->status = $request->status;
        }

        if ($request->has('description')) {
            $client->description = $request->description;
        }


        if (! $client->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $client->save();
        return $this->showOne($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return $this->showOne($client);
    }
}
