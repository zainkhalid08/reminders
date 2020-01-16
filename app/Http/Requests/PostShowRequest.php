<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $post = $this->route('post'); // App\Post

        if (  ( auth()->guest() && $post->isUnpublished() ) || ( auth()->check() && auth()->user()->cannotCreatePost() )  ) {
            abort(404);
        }        

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

}
