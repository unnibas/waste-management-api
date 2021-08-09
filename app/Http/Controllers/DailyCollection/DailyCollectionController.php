<?php

namespace App\Http\Controllers\DailyCollection;

use App\Http\Controllers\ApiController;
use App\Models\CollectionPoint;
use App\Models\DailyCollection;
use App\Transformers\DailyCollectionTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyCollectionController extends ApiController
{
    public function __construct()
    {
        parent:: __construct();
        $this->middleware('transform.input:' . DailyCollectionTransformer::class)->only(['store']);
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
            'collection_point_id' => 'required',
        ];

        $this->validate($request, $rules);

        if (! $this->isSameClient($request->collection_point_id)) {
            return $this->errorResponse('User and Collection Point must be of same client', 400);
        }

        

        $user =  auth()->user();

        $data = $request->all();
        
        $data['user_id'] = $user->id;
        $data['collection_point_id'] = (int)$data['collection_point_id'];
        $data['collection_time'] = Carbon::now();

        $daily_collection = DailyCollection::create($data);

        return $this->showOne($daily_collection);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DailyCollection  $dailyCollection
     * @return \Illuminate\Http\Response
     */
    public function show(DailyCollection $collection)
    {
        
        if (! $this->isSameClient($collection->collection_point_id)) {
            return $this->errorResponse('User and Collection Point must be of same client', 400);
        }

        return $this->showOne($collection);

    }

    public function isSameClient($cp_id)
    {
        $collection_point = CollectionPoint::findOrFail($cp_id);
        $client_id = $collection_point->subArea->area->client_id;
        $client_id_user = auth()->user()->client->first()->id;

        if ($client_id == $client_id_user) {
            return true;
        }

        return false;
    }

    
}
