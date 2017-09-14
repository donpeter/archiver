<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'alt', 'caption', 'type', 'size', 'slug'];

    /**
     * Get the mail related to the file.
     *
     * @return Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function mail()
    {
        return $this->belongsToMany('App\Document')->withTimestamps();
    }
}
