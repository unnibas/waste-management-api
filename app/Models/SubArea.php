<?php

namespace App\Models;

use App\Transformers\SubAreaTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubArea extends Model
{
    use HasFactory, SoftDeletes;
    
    public $transformer = SubAreaTransformer::class;

    protected $fillable = [
        'name',
        'nick_name',
        'logo_url',
        'description',
        'area_id',
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

    protected $hidden = [
        'pivot',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function collectionPoints()
    {
        return $this->hasMany(CollectionPoint::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'duties');
    }
}
