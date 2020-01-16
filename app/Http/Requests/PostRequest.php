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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->all()); // this gets validated
        return [
            'title' => 'required|string',
            'speaker' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'video_src' => 'required|string|url', // eg https://www.youtube.com/embed/1w5dwdblh58
            'tags' => 'required|string',
            'content' => 'required|string|min:10',
            'mins_read' => 'required|numeric|min:1',
            'meta' => 'nullable|array',
        ];
    }

    /**
     * Separate Combined Tags
     * 
     * @param  string $combinedTags comma separated
     * @return array               
     */
    public function separateTags($combinedTags = '') : array
    {
        $separatedRawTags = explode(',', $combinedTags);
        $separatedFilteredTags = array_filter($separatedRawTags);
        return $separatedRawTags;
    }    

}
