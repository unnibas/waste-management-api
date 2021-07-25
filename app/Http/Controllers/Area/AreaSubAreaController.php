<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\SubArea;
use Illuminate\Http\Request;

class AreaSubAreaController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Area $area)
    {
        $subAreas = $area->subAreas;
        return $this->showAll($subAreas);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Area $area)
    {
        $rules = [
            'name' => 'required',
            'nick_name' => 'required',
            'logo_url' =>'image',
            'description' => 'required'
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['area_id'] = $area->id;
        $data['logo_url'] = $request->logo_url->store('');

        $subArea = SubArea::create($data);

        return $this->showOne($subArea);
    }

}
