<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'user_details';

    protected $fillable = [
        'id',
        'user_id',
        'profile_image',
        'background_image',
        'connect_url',
        'connect_fb',
        'connect_twitter',
        'connect_linkedin',
        'location',
        'address',
        'about_me',
        'gender',
    ];
}
