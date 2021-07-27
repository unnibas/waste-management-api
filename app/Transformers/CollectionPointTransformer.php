<?php

namespace App\Transformers;

use App\Models\CollectionPoint;
use League\Fractal\TransformerAbstract;

class CollectionPointTransformer extends TransformerAbstract
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
    public function transform(CollectionPoint $collectionPoint)
    {
        return [
            'identifier' => (int)$collectionPoint->id,
            'name' => (string)$collectionPoint->name,
            'latitude' => (string)$collectionPoint->latitude,
            'longitude' =>  (string)$collectionPoint->longitude,
            'cardId' => (string)$collectionPoint->card_id,
            'phone' => (string)$collectionPoint->phone,
            'email' => (string)$collectionPoint->email,
            'barcode' => (string)$collectionPoint->barcode,
            'address' => (string)$collectionPoint->address,
            'pincode' => (string)$collectionPoint->pincode,
            'creationDate' => (string)$collectionPoint->created_at,
            'lastChange' => (string)$collectionPoint->updated_at,
            'deletedDate' => isset($collectionPoint->deleted_at) ? (string)$collectionPoint->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'cardId' => 'card_id',
            'phone' => 'phone',
            'email' => 'email',
            'barcode' => 'barcode',
            'address' => 'address',
            'pincode' => 'pincode',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'card_id' => 'cardId',
            'phone' => 'phone',
            'email' => 'email',
            'barcode' => 'barcode',
            'address' => 'address',
            'pincode' => 'pincode',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
