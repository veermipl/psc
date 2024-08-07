<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembershipType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "membership_types";

    protected $fillable = [
        'name',
        'status',
    ];
}
