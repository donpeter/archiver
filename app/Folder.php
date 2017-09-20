<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Folder extends Model
{

    use SoftDeletes;   

    protected $dates = ['deleted_at'];

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'ref', 'desc'
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
