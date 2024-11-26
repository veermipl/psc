<?php

namespace App\Models;

use App\Models\Albums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'photos';

    protected $fillable = [
        'name',
        'title',
        'album_id',
        'status',
    ];

    public function album()
    {
        return $this->belongsTo(Albums::class);
    }
}
