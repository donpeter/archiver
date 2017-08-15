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
      $this->attributes['prepaired_on'] = Carbon::createFromFormat('d/m/Y',$date);
    }

    /**
    * Signed on Mututor
    *
    */
    public function setSignedOnAttribute($date){
        if (is_null($date)) {
            $this->attributes['signed_on'] = null;
        }else {
            $this->attributes['signed_on'] = Carbon::createFromFormat('d/m/Y',$date);
        }
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

    /**
     * Get the Organization related to the mail.
     *
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function from()
    {
        return $this->belongsTo('App\Organization', 'sender');
    }

    /**
     * Get the Organization related to the mail.
     *
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function to()
    {
        return $this->belongsTo('App\Organization', 'receiver');
    }

}
