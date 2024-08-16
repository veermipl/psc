<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TradeData extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trade_data';

    protected $fillable = [
        'title',
        'content',
        'file',
        'type',
        'status',
    ];
}
