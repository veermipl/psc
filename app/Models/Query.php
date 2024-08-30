<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Query extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'queries';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'type',
    ];
}
