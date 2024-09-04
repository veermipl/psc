<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LandingPage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "landing_page";

    protected $fillable = [
        'title',
        'content',
        'file',
        'type',
        'link',
        'icon',
        'status',
    ];
}
