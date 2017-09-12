<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Organization extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
         'country',
         'location',
         'email',
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
