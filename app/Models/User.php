<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Permission;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'membership_type',
        'form_pdf',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasRole($role)
    {
        return $this->role()->where('name', $role)->exists();
    }

    public function hasPermission($permission)
    {
        return $this->permissions()->where('name_key', $permission)->exists() ||
            $this->role()->whereHas('permissions', function ($query) use ($permission) {
                $query->where('name_key', $permission);
            })->exists();
    }

    public function membership()
    {
        return $this->hasOne(MembershipType::class, 'id', 'membership_type');
    }

    public function supportingDoc()
    {
        return $this->hasMany(MemberFiles::class);
    }
}
