<?php

namespace App;

use App\Speaker;
use App\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Traits\PostViewHelper;

class Post extends Model
{
    use SoftDeletes, PostViewHelper;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'speaker_id',
        'location_id',
        'date',
        'video_src',
        'image_src',
        'mins_read',
        'user_id',
        'published_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'speaker_id' => 'integer',
        'location_id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at', 'date'
    ];

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function location()
    {
        return $this->belongsTo(\App\Location::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

}
