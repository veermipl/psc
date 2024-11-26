<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlbumPhotos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'album_photos';

    protected $fillable = [
        'album_id',
        'name',
        'status',
    ];
}
