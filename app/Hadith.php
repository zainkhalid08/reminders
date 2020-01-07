<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hadith extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'post_id', 'reference'];
}
