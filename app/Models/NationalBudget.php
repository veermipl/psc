<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NationalBudget extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'national_budget';

    protected $fillable = [
        'title',
        'content',
        'file',
        'type',
        'status',
    ];
}
