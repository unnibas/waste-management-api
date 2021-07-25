<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\ApiController;
use App\Models\Area;
use App\Models\Client;
use App\Transformers\AreaTransformer;
use Illuminate\Http\Request;

class ClientAreaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('transform.input:' . AreaTransformer::class)->only(['store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        $areas = $client->areas;
        return $this->showAll($areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $rules = [
            'name' => 'required',
            'logo_url' => 'image|required',
            'description' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $data['logo_url'] = $request->logo_url->store('/');
        $data['client_id'] = $client->id;

        $area = Area::create($data);

        return $this->showOne($area);
    }

}
