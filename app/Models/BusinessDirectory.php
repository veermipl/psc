<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessDirectory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "business_directories";

    protected $fillable = [
        'name',
        'sub_name',
        'status',
    ];
}
