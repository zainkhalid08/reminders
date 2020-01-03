<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'english', 'ayahs'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
