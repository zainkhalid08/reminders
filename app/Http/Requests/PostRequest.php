<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if user can create post
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($tags = $this->get('tags')) {
            $this->filterTags($tags);
        }
        // dd($this->get('tags'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd(request()->all());
        // dd($this->all());
        return [
            'title' => 'required|string',
            'speaker' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'video_src' => 'required|string|url', // eg https://www.youtube.com/embed/1w5dwdblh58
            'tags' => 'required|array|min:1|filled',
            'content' => 'required|string',
        ];
    }

    /**
     * Removes null values from tags.
     *
     * @return void
     */
    protected function filterTags($tags = [])
    {
        $filtered = array_filter($tags, function($value){
            return !is_null($value) ? true : false;
        });
        $this->merge(['tags' => $filtered]);
        // dd($this->get('tags'));
    }


}
