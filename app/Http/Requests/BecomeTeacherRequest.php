<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BecomeTeacherRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'mobile' => 'required|digits:11|unique:users',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'accept_terms' => 'required|in:on'
        ];
    }

    public function messages()
    {
        return [
            'accept_terms.required' => 'Please Accept Terms and Privacy Policy'
        ];
    }

    public function getValidatorInstance()
    {
        $this->mergeUserId();

        return parent::getValidatorInstance();
    }

    protected function mergeUserId()
    {
        $this->merge([
            'user_id' => auth()->user()->id
        ]);
    }

}
