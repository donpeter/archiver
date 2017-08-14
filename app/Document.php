<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Document extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'ref', 'title','desc', 'sender', 'receiver', 'type',
         'prepaired_on', 'signed_on'
    ];

    /**
     * The attributes will be treated as a carbon instance.
     *
     * @var array
     */
    protected $dates = ['prepaired_on', 'signed_on'];



    /**
    * Prepiared on Mututor
    *
    */
    public function setPrepairedOnAttribute($date){
      $this->attributes['prepaired_on'] = Carbon::parse($date);
    }

    /**
    * Signed on Mututor
    *
    */
    public function setSignedOnAttribute($date){
      $this->attributes['signed_on'] = Carbon::parse($date);
    }

    /**
    * Signed Mail Scope
    *
    */
    public function scopeSigned($query){
      $query->where('signed_on', '!=', null);
    }

    /**
     * Get the Files related to the mail.
     *
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('App\File')->withTimestamps();
    }

}
