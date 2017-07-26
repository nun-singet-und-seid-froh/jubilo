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
    
    
    public function roles(){
      return $this->belongsToMany('App\Models\Role');
    }
    
    public function hasRole($role) {
        foreach ( $user->roles()->get() as $userRole ) {
            if ( $role == $userRole['name'] ) {
                return true;
            }
        }
        return false;
    }
}
