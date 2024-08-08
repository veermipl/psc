<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'setting';

    protected $fillable = [
        'meta_key',
        'meta_value',
        'meta_type',
    ];
}
