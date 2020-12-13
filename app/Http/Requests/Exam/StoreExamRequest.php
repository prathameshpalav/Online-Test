<?php

namespace App\Http\Requests\Exam;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamRequest extends FormRequest
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
            'exam_title'                => 'required|max:200',
            'time_required_in_minutes'  => 'required|integer',
            'total_marks'               => 'required|integer|min:1',
            'passing_marks'             => 'required|integer|min:1|lte:total_marks',
            'questions'                 => 'required|array'
        ];
    }
}
