<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function getPermissionsAttribute()
    {
        return Permission
            ::join('role_permission', 'permissions.id', '=', 'role_permission.permission_id')
            ->join('roles', 'role_permission.role_id', '=', 'roles.id')
            ->join('role_user', 'roles.id', '=', 'role_user.role_id')
            ->join('users', 'role_user.user_id', '=', 'users.id')
            ->where('users.id', $this->id)
            ->select('permissions.name','permissions.slug', 'permissions.description')
            ->get();
    }
}
