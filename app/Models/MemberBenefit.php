<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberBenefit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "member_benefits";

    protected $fillable = [
        'name',
        'status',
    ];
}
