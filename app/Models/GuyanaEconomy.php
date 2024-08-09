<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuyanaEconomy extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "guyana_economies";

    protected $fillable = [
        'title',
        'content',
        'images',
        'status',
    ];
}
