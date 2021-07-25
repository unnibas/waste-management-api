<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\ApiController;
use App\Models\Client;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class ClientUserController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('transform.input:' . UserTransformer::class)->only(['store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        $users = $client->users;
        return $this->showAll($users);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client, User $user)
    {
        $rules = [
            'name' =>'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:8',
        ];

        $this->validate($request, $rules);
        
        $data = $request->all();

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $client->users()->syncWithoutDetaching([$user->id]);

        return $this->showOne($user);
    }

}
