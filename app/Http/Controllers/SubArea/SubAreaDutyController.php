<?php

namespace App\Http\Controllers\SubArea;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\SubArea;
use App\Models\User;
use Illuminate\Http\Request;

class SubAreaDutyController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubArea $subarea)
    {
        $all_users = $subarea->users()->get();
        return $this->showAll($all_users);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SubArea $subarea)
    {
        $array = $request->all();

        if (!$this->isSameClient($subarea, $array)) {
            return $this->errorResponse('Users must be of same client', 400);  
        }

        $subarea->users()->sync($array);
        
        $all_users = $subarea->users()->get();

        return $this->showAll($all_users);
        
    }

    public function isSameClient(SubArea $subarea, $array)
    {
        $client = $subarea->area()->with('client')->get()
        ->pluck('client')->first();

        foreach ($array as  $value) {
            $user = User::findOrFail($value);

            if (isset($user->client->first()->id)) {
                if ($user->client->first()->id != $client->id) {
                    return false;
                }
            } else {
                return false;
            }    
        }
        
        return true;
    }

}
