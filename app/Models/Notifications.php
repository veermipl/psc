<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifications extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notifications';

    protected $fillable = [
        'id',
        'title',
        'message',
        'link',
        'type',
        'read',
    ];
}
