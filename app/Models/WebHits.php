<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebHits extends Model
{
    use HasFactory;

    public $fillable = [
        'ip_address',
        'url',
    ];
}
