<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FirstStepCreateCourseRequest extends FormRequest
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
            'title' => 'required|string|min:1',
            'category_id' => 'required|integer',
            'price' => 'required|integer',
            'language' => 'required',
            'level' => 'required|in:all,beginner,intermediate,expert',
            'requirements' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|mimes:jpeg,jpg,png|image|max:1024', //max 1 mb
        ];
    }
}
