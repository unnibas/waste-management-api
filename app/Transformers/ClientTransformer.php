<?php

namespace App\Transformers;

use App\Models\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
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
    public function transform(Client $client)
    {
        return [
            'identifier' => (int)$client->id,
            'name' => (string)$client->name,
            'email' => (string)$client->email,
            'phone' => (string)$client->phone,
            'address' => (string)$client->address,
            'pincode' => (string)$client->pincode,
            'details' => (string)$client->description,
            'isActive' => (int)$client->isActive(),
            'creationDate' => (string)$client->created_at,
            'lastChange' => (string)$client->updated_at,
            'deletedDate' => isset($client->deleted_at) ? (string)$client->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('clients.show',$client->id),
                ],
                [
                    'rel' => 'clients.users',
                    'href' => route('clients.users.index',$client->id),
                ],
                [
                    'rel' => 'clients.areas',
                    'href' => route('clients.areas.index',$client->id)
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'email' => 'email',
            'phone' => 'phone',
            'address' => 'address',
            'pincode' => 'pincode',
            'details' => 'description',
            'isActive' => 'status',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index) 
    {
        $attributes = [
            'id' => 'identifier',
            'name' => 'name',
            'email' => 'email',
            'phone' => 'phone',
            'address' => 'address',
            'pincode' => 'pincode',
            'description' => 'details',
            'status' => 'isActive',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
