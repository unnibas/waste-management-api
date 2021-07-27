<?php

namespace App\Http\Controllers\SubArea;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\SubArea;
use App\Transformers\SubAreaTransformer;
use Illuminate\Http\Request;

class SubAreaController extends ApiController
{
    public function __construct()
    {
        parent:: __construct();
        $this->middleware('transform.input:' . SubAreaTransformer::class)->only(['update']);
    }

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
    public function update(Request $request, SubArea $subarea)
    {
        $rules = [
            'logo_url' => 'image',
        ];

        $this->validate($request, $rules);


        if ($request->has('name')) {
            $subarea->name = $request->name;
        }

        if ($request->has('nick_name')) {
            $subarea->nick_name = $request->nick_name;
        }

        if ($request->has('logo_url')) {
            $subarea->logo_url = $request->logo_url->store('');
        }

        if ($request->has('description')) {
            $subarea->description = $request->description;
        }

        if (! $subarea->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $subarea->save();
        return $this->showOne($subarea);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubArea  $subArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubArea $subarea)
    {
        $subarea->delete();
        return $this->showOne($subarea);
    }
}
