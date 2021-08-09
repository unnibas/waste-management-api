<?php

namespace App\Transformers;

use App\Models\DailyCollection;
use League\Fractal\TransformerAbstract;

class DailyCollectionTransformer extends TransformerAbstract
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
    public function transform(DailyCollection $dailyCollection)
    {
        return [
            'identifier' => (int)$dailyCollection->id,
            'user' => [
                'userId' => (int)$dailyCollection->user_id,
                'name' => $dailyCollection->user->name,
            ],
            'collectionPoint' => [
                'collectionPointId' => (int)$dailyCollection->collection_point_id,
                'name' => $dailyCollection->collectionPoint->name,
            ],
            'remark' => (string)$dailyCollection->remark,
            'clientRating' => (string)$dailyCollection->client_rating,
            'userRating' => (string)$dailyCollection->user_rating,
            'collectionTime' => (string)$dailyCollection->collection_time,
            'creationDate' => (string)$dailyCollection->created_at,
            'lastChange' => (string)$dailyCollection->updated_at,
            'deletedDate' => isset($dailyCollection->deleted_at) ? (string)$dailyCollection->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'remark' => 'remark',
            'collectionPointId' => 'collection_point_id',
            'clientRating' => 'client_rating',
            'userRating' => 'user_rating',
            'collectionTime' => 'collection_time',
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
            'remark' => 'remark',
            'collection_point_id' => 'collectionPointId',
            'client_rating' => 'clientRating',
            'user_rating' => 'userRating',
            'collection_time' => 'collectionTime',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
