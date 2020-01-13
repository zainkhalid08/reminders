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
        $data['Vw82iwl'] = strtolower($data['Vw82iwl']); // verification (checking for spam)
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
            'n3kIad3' => 'nullable|string',
            'eaWDsk2' => 'nullable|string|email',
            'mw2s8sJ' => 'required|string|max:700',
            'Vw82iwl' => 'required|in:2,two',
        ];
    }
}
