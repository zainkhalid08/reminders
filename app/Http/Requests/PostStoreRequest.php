<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ( auth()->guest() || auth()->user()->cannotCreatePost() ) {
            abort(404);
        }
        
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $data = $this->all();
        $data['words'] = strtolower($data['words']); // to keep words unique, in words table, for spellings
        $this->replace($data);
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
            'meta.description' => 'required|string|max:160',
            'words' => 'nullable|string',
        ];
    }

}
