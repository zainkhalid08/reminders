<?php

namespace App\Contracts;

interface SimilarityCheckable
{
    /**
     * The column name, where similarity
     * is to be checked
     *
     * @return string
     */
    public function content() : string ;

    /**
     * Similarity threshold
     *
     * @return float
     */
    public function threshold() : float ;

    /**
     * Get all of the models from the database.
     *
     * NOTE: this is the laravel implementaion of all()
     * on an eloquent model
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function all($columns = ['*']);

}
