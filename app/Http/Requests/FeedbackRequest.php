<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     * to allow even if user enters
     * TWO or in any other way.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $data = $this->all();
        $data['verification'] = strtolower($data['verification']);
        $this->replace($data);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'email' => 'nullable|string|email',
            'message' => 'required|string|max:700',
            'verification' => 'required|in:2,two',
        ];
    }
}
