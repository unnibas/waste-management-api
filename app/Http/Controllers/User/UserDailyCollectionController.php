<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\DailyCollection;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserDailyCollectionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $daily_collections = $user->dailyCollections()->with('user')->get();
        return $this->showAll($daily_collections);
    }


}
