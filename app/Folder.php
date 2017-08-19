<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'ref', 'desc'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];
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
