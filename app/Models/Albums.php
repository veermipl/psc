<?php

namespace App\Models;

use App\Models\Photos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Albums extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'albums';

    protected $fillable = [
        'name',
        'image',
        'status',
    ];

    public function photos()
    {
        return $this->hasMany(Photos::class);
    }
}
