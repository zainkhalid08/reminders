<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feedbacks';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'message'
    ];

}
