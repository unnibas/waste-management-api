<?php

namespace App\Models;

use App\Transformers\AreaTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    public $transformer = AreaTransformer::class;

    protected $fillable = [
        'name',
        'client_id',
        'logo_url',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function subAreas()
    {
        return $this->hasMany(SubArea::class);
    }
}
