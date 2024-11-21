<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExecutiveCommitteess extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'executive_committeess';

    protected $fillable = [
        'name',
        'image',
        'designation',
        'email',
        'mobile_number',
        'terms_of_reference',
        'facebook',
        'twitter',
        'instagram',
        'dribbble',
        'status',
    ];
}
