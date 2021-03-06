<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Permissions\HasPermissionsTrait;

class User extends Authenticatable 
// implements MustVerifyEmail
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        $roles = $this->roles()->where('name', $role)->count();

        if ($roles == 1) {
            return true;
        }
        return false;
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function checkTrash()
    {   
        $articles = $this->articles()->onlyTrashed()->whereNotNull('deleted_at')->where('user_id', auth()->user()->id)->get();

        if (count($articles) > 0) {
            return true;
        }

        return false;
    }
}
