<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    
    protected $fillable = [
        'module',
        'name',
        'name_key',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
}
