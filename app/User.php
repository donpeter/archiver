<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;

    
    use SoftDeletes;   

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isStaff()
    {
        return $this->role === 'admin' || $this->role === 'staff';
    }


    /**
     * Eloquent Model Relation
     *
     *@var App\Organization::class
     */
    public function  documents()
    {
        return $this->hasMany('App\Document');
    }

}
