<?php

namespace App\Transformers;

use App\Models\Device;
use League\Fractal\TransformerAbstract;

class DeviceTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Device $device)
    {
        return [
            'identifier' => (int)$device->id,
            'deviceId' => (string)$device->device_id,
            'timeStamp' => (string)$device->time_stamp,
            'deviceType' => (string)$device->device_type,
            'deviceData' => (array)$device->data,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'deviceId' => 'device_id',
            'timeStamp' => 'time_stamp',
            'deviceType' => 'device_type',
            'deviceData' => 'data',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_date',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index) 
    {
        $attributes = [
            'id' => 'identifier',
            'device_id' => 'deviceId',
            'time_stamp' => 'timeStamp',
            'device_type' => 'deviceType',
            'data' => 'deviceData',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
