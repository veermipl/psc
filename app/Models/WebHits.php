<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebHits extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'web_hits';

    protected $fillable = [
        'user_ip',
        'time',
    ];
}
