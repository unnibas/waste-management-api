<?php

namespace App\Transformers;

use App\Models\SubArea;
use League\Fractal\TransformerAbstract;

class SubAreaTransformer extends TransformerAbstract
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
    public function transform(SubArea $subArea)
    {
        return [
            'identifier' => (int)$subArea->id,
            'name' => (string)$subArea->name,
            'nickName' => (string)$subArea->nick_name,
            'logo_url' => (string)$subArea->logo_url,
            'details' => (string)$subArea->description,
            'areaId' => (int)$subArea->area_id,
            'creationDate' => (string)$subArea->created_at,
            'lastChange' => (string)$subArea->updated_at,
            'deletedDate' => isset($subArea->deleted_at) ? (string)$subArea->deleted_at : null,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('subareas.show',$subArea->id),
                ],
                [
                    'rel' => 'subareas.cpoints',
                    'href' => route('subareas.cpoints.index',$subArea->id),
                ],
                [
                    'rel' => 'subareas.duties',
                    'href' => route('subareas.duties.index',$subArea->id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'nickName' => 'nick_name',
            'logo_url' => 'logo_url',
            'details' => 'description',
            'areaId' => 'area_id',
            'creationDate' =>'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at'
        ];
        
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index) 
    {
        $attributes = [
            'id' => 'identifier',
            'name' => 'name',
            'nick_name' => 'nickName',
            'logo_url' => 'logo_url',
            'description' => 'details',
            'area_id' => 'areaId',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
