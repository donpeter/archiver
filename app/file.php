<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class File extends Model
{
    use SoftDeletes;   

    protected $dates = ['deleted_at'];
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
