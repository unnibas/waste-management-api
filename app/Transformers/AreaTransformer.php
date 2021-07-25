<?php

namespace App\Transformers;

use App\Models\Area;
use League\Fractal\TransformerAbstract;

class AreaTransformer extends TransformerAbstract
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
    public function transform(Area $area)
    {
        return [
            'identifier' => (int)$area->id,
            'name' => (string)$area->name,
            'logo_url' => (string)$area->logo_url,
            'details' => (string)$area->description,
            'creationDate' => $area->created_at,
            'lastChange' => $area->updated_at,
            'deletedDate' => isset($area->deleted_at) ? (string)$area->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('areas.show', $area->id),
                ],
                [
                    'rel' => 'areas.subareas',
                    'href' => route('areas.subareas.index', $area->id),
                ] 
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'logo_url' => 'logo_url',
            'details' => 'description',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at', 
            'deletedData' => 'deleted_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index) 
    {
        $attributes = [
            'id' => 'identifier',
            'name' => 'name',
            'logo_url' => 'logo_url',
            'description' => 'details',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
