<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
        //dd($this->request);
        return [
            'quiz_section_id' => 'required|integer',
            'title' => 'required|string|min:5',
            'type' => 'required|string',
            'mark' => 'required|numeric',
            'answers' => 'required_if:type,mcq|exclude_if:type,true_false|array|min:4|max:4',
            'answers.*' => 'exclude_if:type,true_false|required_if:type,mcq|string|distinct|min:3',
            'correct_answers' => 'required_if:type,mcq,true_false|array',
            'correct_answers.0' => 'required_if:type,mcq|exclude_if:type,true_false|integer',
            'correct_answers.1' => 'required_if:type,true_false|exclude_if:type,mcq|in:true,false'
        ];
    }

    public function messages()
    {
        return [
            //'correct_answers.0.required_if' => 'Please Select Correct Answer',
            //'correct_answers.0.integer' => 'Please Select Correct Answer',
            //'correct_answers.1.required_if' => 'Please Select Correct Answer',
            //'correct_answers.1.boolean' => 'Please Select Correct Answer',
            'answers.0.required_if' => 'Answer 1 is reqired',
            'answers.1.required_if' => 'Answer 2 is reqired',
            'answers.2.required_if' => 'Answer 3 is reqired',
            'answers.3.required_if' => 'Answer 4 is reqired',
            'answers.0.distinct' => 'Answer 1 field has a duplicate value.',
            'answers.1.distinct' => 'Answer 2 field has a duplicate value.',
            'answers.2.distinct' => 'Answer 3 field has a duplicate value.',
            'answers.3.distinct' => 'Answer 4 field has a duplicate value.',
        ];
    }
}
