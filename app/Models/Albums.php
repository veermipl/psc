<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Albums extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'albums';

    protected $fillable = [
        'name',
        'status',
    ];
}
