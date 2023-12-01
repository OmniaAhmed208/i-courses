<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
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
            'name' => 'required|string|min:1',
            'time' => 'required|integer|not_in:0',
            'section_id' => 'required|integer',
            'is_free' => 'required|boolean',
            'type' => 'required|string|min:1',
            'link' => 'sometimes|string',
            'video' => 'required_if:type,internal_link|mimetypes:video/mp4|mimes:mp4',
            'number_of_views' => 'required|numeric|min:0'
        ];
    }
}
