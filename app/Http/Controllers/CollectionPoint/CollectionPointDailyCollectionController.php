<?php

namespace App\Http\Controllers\CollectionPoint;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\CollectionPoint;
use Illuminate\Http\Request;

class CollectionPointDailyCollectionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CollectionPoint $cpoint)
    {
        return $this->showAll($cpoint->dailyCollections);
    }

}
