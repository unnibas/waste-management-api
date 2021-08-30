<?php

namespace App\Http\Controllers\Device;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Traits\ApiResponser;
use App\Transformers\DeviceTransformer;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware('transform.input:' . DeviceTransformer::class)->only(['index','store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $devices = Device::all();

        // return $this->showAll($devices);

        $rules = [
            'device_id' => 'required',
            'time_stamp' => 'required',
            'device_type' => 'required',
            'data' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $device = Device::create($data);

        return $this->showOne($device);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'device_id' => 'required',
            'time_stamp' => 'required',
            'device_type' => 'required',
            'data' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $device = Device::create($data);

        return $this->showOne($device);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        return $this->showOne($device);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        //
    }
}
