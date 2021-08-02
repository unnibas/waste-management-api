<?php

namespace App\Models;

use App\Transformers\DailyCollectionTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyCollection extends Model
{
    use HasFactory, SoftDeletes;

    public $transformer = DailyCollectionTransformer::class;

    protected $fillable = [
        'user_id',
        'collection_point_id',
        'remark',
        'client_rating',
        'user_rating',
        'collection_time',
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
        'collection_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function collectionPoint()
    {
        return $this->belongsTo(CollectionPoint::class);
    }

}
