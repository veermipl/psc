<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberFiles extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'member_files';

    protected $fillable = [
        'user_id',
        'file_name',
        'file_for',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
