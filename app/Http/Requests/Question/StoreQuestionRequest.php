<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question'          => 'required',
            'option1'           => 'required|max:500',
            'option2'           => 'required|max:500',
            'option3'           => 'required|max:500',
            'option4'           => 'required|max:500',
            'correct_option'    => 'required|in:1,2,3,4',
        ];
    }

    public function messages()
    {
        return [
            'correct_option.required'   => 'Please select any one correct option.',
            'correct_option.in'         => 'Please select valid correct option.',
        ];
    }
}
