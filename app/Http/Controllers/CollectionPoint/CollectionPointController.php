<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\CollectionPoint;
use Illuminate\Http\Request;

class CollectionPointController extends ApiController
{
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CollectionPoint  $collectionPoint
     * @return \Illuminate\Http\Response
     */
    public function show(CollectionPoint $collectionPoint)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CollectionPoint  $collectionPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CollectionPoint $collectionPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CollectionPoint  $collectionPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(CollectionPoint $collectionPoint)
    {
        //
    }
}
