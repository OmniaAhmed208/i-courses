<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResorcesRequest extends FormRequest
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
            'files' => 'required|array|min:1',
            'files.*' => 'required|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/jpeg,image/png|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,csv,jpg,jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'files.*.mimetypes' => 'Extensions is not supported',
            'files.*.mimes' => 'Extensions is not supported',
        ];
    }
}
