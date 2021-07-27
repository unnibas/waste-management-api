<?php

namespace App\Models;

use App\Transformers\CollectionPointTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionPoint extends Model
{
    use HasFactory, SoftDeletes;

    public $transformer = CollectionPointTransformer::class;

    protected $fillable= [
        'sub_area_id',
        'name',
        'latitude',
        'longitude',
        'card_id',
        'phone',
        'email',
        'barcode',
        'address',
        'pincode',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function subArea()
    {
        return $this->belongsTo(SubArea::class);
    }
}
