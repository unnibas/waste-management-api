<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionRequest extends Model
{
    use HasFactory, SoftDeletes;

    const PENDING_REQUEST = '0';
    const SOLVED_REQUEST = '1';
}
