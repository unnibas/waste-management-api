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
            'logoUrl' => (string)$subArea->logo_url,
            'description' => (string)$subArea->description,
            'areaId' => (int)$subArea->area_id,
            'creationDate' => $subArea->created_at,
            'lastChange' => $subArea->updated_at,
        ];
    }

    public static function originalAttributr($index)
    {
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'nickName' => 'nick_name',
            'logoUrl' => 'logo_url',
            'description' => 'description',
            'areaId' => 'area_id',
            'creationDate' =>'created_at',
            'lastChange' => 'updated_at',
        ];
        
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
