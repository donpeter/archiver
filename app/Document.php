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
         'ref', 'title','desc', 'user_id', 'folder_id', 'type','organization_id', 'written_on', 'signed_on'
    ];

    /**
     * The attributes will be treated as a carbon instance.
     *
     * @var array
     */
    protected $dates = ['written_on', 'signed_on'];



    /**
    * Prepiared on Mututor
    *
    */
    public function setWrittenOnAttribute($date){
      $this->attributes['written_on'] = Carbon::createFromFormat('d/m/Y',$date);
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
    * Signed Document Scope
    *
    */
    public function scopeSigned($query){
      $query->where('signed_on', '!=', null);
    }

    /**
     * Get the Files related to the Document.
     *
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('App\File')->withTimestamps();
    }

    /**
     * Get the Organization related to the Document.
     *
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    /**
     * Get the Organization related to the Document.
     *
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function folder()
    {
        return $this->belongsTo('App\Folder');
    }

    /**
     * Get the User related to the Document.
     *
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function parse()
    {
        $this->files;
        $this->user;
        $this->folder;
        $this->organization;
    }
}
