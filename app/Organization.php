<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Organization extends Model
{
    use SoftDeletes;   

    protected $dates = ['deleted_at'];
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
