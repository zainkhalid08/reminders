<?php

namespace App;

use App\Jobs\ProcessPostContent;
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

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    // protected static function boot()
    // {
    //     parent::boot();
    //     $events = ['updated', 'created'];
    //     foreach ($events as $event) {
    //         static::{$event}(function ($post) {
    //             $post->unpublish();
    //             // ProcessPostContent::dispatch($post)->delay(now()->addMinutes(1)); // use delay when you have a queue driver setup
    //         });
    //     }
    // }

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
        return $query->whereNotNull('is_published');
    }

    public function isUnpublished() : bool
    {
        return ! $this->is_published;
    }

    public function publish() 
    {
        $this->is_published = true;
        $this->save();
    }

    public function unpublish() 
    {
        $this->is_published = false;
        $this->save();
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

}
