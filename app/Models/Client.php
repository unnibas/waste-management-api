<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Transformers\ClientTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    const ACTIVE_CLIENT = '1';
    const INACTIVE_CLIENT = '0';

    public $transformer = ClientTransformer::class;

    protected $fillable = [
        'name',
        'email',
        'description',
        'phone',
        'address',
        'pincode',
        'status',
    ];

    protected $hidden = [
        'pivot'
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

    public function users() 
    {
        return $this->belongsToMany(User::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function isActive()
    {
        return $this->status == Client::ACTIVE_CLIENT;
    }
}
