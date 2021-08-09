<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Models\SubArea;
use App\Models\User;
use Illuminate\Http\Request;

class UserDutyController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {

        $areas =  $user->subAreas()->with('area')->get()
        ->pluck('area')
        ->unique('id')
        ->values();

        return $this->showAll($areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        if (! $this->isSameClient($user,$request->all())) {
            return $this->errorResponse('Subareas must be of same client', 400);   
        }

        $user->subareas()->sync($request->all());

        return $this->showAll($user->subareas()->get());

    }

    public function isSameClient(User $user, $array)
    {
        $user_client = $user->client->first();

        foreach ($array as  $value) {
            $subarea = SubArea::findOrFail($value)->area;

            if ($subarea->client_id != $user_client->id) {
                return false;
            }
              
        }
        
        return true;
    }

}
