<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssignmentQuestionsRequest extends FormRequest
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
            'assignment_section_id' => 'required|integer',
            'title' => 'required|string|min:1',
            'type' => 'required|string',
            'mark' => 'required|numeric',
            'answers' => 'required_if:type,mcq|exclude_if:type,true_false|array|min:4|max:4',
            'answers.*' => 'exclude_if:type,true_false|required_if:type,mcq|string|distinct|min:1',
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
            'answers.0.required_if' => 'Answer 1 is required',
            'answers.1.required_if' => 'Answer 2 is required',
            'answers.2.required_if' => 'Answer 3 is required',
            'answers.3.required_if' => 'Answer 4 is required',
            'answers.0.distinct' => 'Answer 1 field has a duplicate value.',
            'answers.1.distinct' => 'Answer 2 field has a duplicate value.',
            'answers.2.distinct' => 'Answer 3 field has a duplicate value.',
            'answers.3.distinct' => 'Answer 4 field has a duplicate value.',
        ];
    }
}
