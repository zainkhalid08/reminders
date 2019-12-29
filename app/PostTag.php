<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'tag_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'tag_id' => 'integer',
    ];


    public function post()
    {
        return $this->belongsTo(\App\Posts::class);
    }

    public function tag()
    {
        return $this->belongsTo(\App\Tags::class);
    }
}
