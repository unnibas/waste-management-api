<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Http\Controllers\ApiController;
use App\Models\CollectionPoint;
use App\Transformers\CollectionPointTransformer;
use Illuminate\Http\Request;

class CollectionPointController extends ApiController
{
    public function __construct()
    {
        parent:: __construct();
        $this->middleware('transform.input:' . CollectionPointTransformer::class)->only(['update']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CollectionPoint  $collectionPoint
     * @return \Illuminate\Http\Response
     */
    public function show(CollectionPoint $cpoint)
    {
        return $this->showOne($cpoint);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CollectionPoint  $collectionPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CollectionPoint $cpoint)
    {
        $rules = [
            'email' => 'email|unique:collection_points,email,' . $cpoint->id,
        ];

        $this->validate($request, $rules);

        if ($request->has('name')) {
            $cpoint->name = $request->name;
        }

        if ($request->has('latitude')) {
            $cpoint->latitude = $request->latitude;
        }

        if ($request->has('longitude')) {
            $cpoint->longitude = $request->longitude;
        }

        if ($request->has('phone')) {
            $cpoint->phone = $request->phone;
        }

        if ($request->has('email')) {
            $cpoint->email = $request->email;
        }

        if ($request->has('address')) {
            $cpoint->address = $request->address;
        }

        if ($request->has('pincode')) {
            $cpoint->pincode = $request->pincode;
        }

        if (! $cpoint->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $cpoint->save();
        return $this->showOne($cpoint);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CollectionPoint  $collectionPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(CollectionPoint $cpoint)
    {
        $cpoint->delete();
        return $this->showOne($cpoint);
    }
}
