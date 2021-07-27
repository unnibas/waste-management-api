<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Transformers\AreaTransformer;
use Illuminate\Http\Request;

class AreaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('transform.input:' . AreaTransformer::class)->only(['update']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        return $this->showOne($area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {

        if ($request->has('name')) {
            $area->name = $request->name;
        }

        if ($request->has('description')) {
            $area->description = $request->description;
        }

        if ($request->has('logo_url')) {
            $area->logo_url = $request->logo_url;
        }

        if (! $area->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $area->save();
        return $this->showOne($area);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        $area->delete();
        return $this->showOne($area);
    }
}
