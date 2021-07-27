<?php

namespace App\Http\Controllers\SubArea;

use App\Http\Controllers\ApiController;
use App\Models\CollectionPoint;
use App\Models\SubArea;
use App\Transformers\CollectionPointTransformer;
use Illuminate\Http\Request;

class SubAreaCollectionPointController extends ApiController
{
    public function __construct()
    {
        parent:: __construct();
        $this->middleware('transform.input:' . CollectionPointTransformer::class)->only(['store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubArea $subarea)
    {
        $cpoints = $subarea->collectionPoints;
        return $this->showAll($cpoints);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SubArea $subarea)
    {
        $rules = [
            'name' => 'required',
            'email' => 'email|required|unique:collection_points',
            'latitude' => 'required',
            'longitude' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'pincode' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['sub_area_id'] = $subarea->id;
        $data['card_id'] = 'no';
        $data['barcode'] = 'no';

        $collectionPoint = CollectionPoint::create($data);
        return $this->showOne($collectionPoint);

    }

    
}
