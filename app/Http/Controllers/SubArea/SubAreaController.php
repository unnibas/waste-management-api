<?php

namespace App\Http\Controllers\SubArea;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\SubArea;
use Illuminate\Http\Request;

class SubAreaController extends ApiController
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubArea  $subArea
     * @return \Illuminate\Http\Response
     */
    public function show(SubArea $subarea)
    {
       return $this->showOne($subarea);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubArea  $subArea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubArea $subArea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubArea  $subArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubArea $subArea)
    {
        //
    }
}
