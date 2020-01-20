<?php

namespace App;

use App\Speaker;
use App\Tag;
use App\Traits\PostViewHelper;
use App\Traits\StringExtractor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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
        'raw_content',
        'speaker_id',
        'location_id',
        'date',
        'video_src',
        'image_src',
        'mins_read',
        'meta',
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
        'meta' => 'array',
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

    public function isUnpublished() : bool
    {
        return ! $this->published_at;
    }

    public function publish() 
    {
        return $this->published_at = now();
    }

    public function unpublish() 
    {
        return $this->published_at = null;
    }

    public function scopeLatestPublishedFirst($query)
    {
        return $query->published()->latest('published_at');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    /**
     * Set the title for the post
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value);
    }

    /**
     * Set the meta for the post
     *
     * @param  string  $value
     * @return void
     */
    // public function setMetaAttribute($value)
    // {
    //     $this->attributes['meta'] = json_encode($value);
    // }    

    /**
     * Get the meta for the post
     *
     * @param  string  $value
     * @return void
     */
    // public function getMetaAttribute($value)
    // {
    //     return json_decode($value);
    // }    

}
