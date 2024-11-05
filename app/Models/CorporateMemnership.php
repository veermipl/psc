<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateMemnership extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $table = 'corporate_membership';
}

