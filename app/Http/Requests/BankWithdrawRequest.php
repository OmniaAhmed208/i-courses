<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankWithdrawRequest extends FormRequest
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
            'instructor_id' => 'required|integer',
            'amount' => 'required|integer|min:1000',
            'name' => 'required|string|min:1',
            'account_number' => 'required|string',
            'bank_name' => 'required|string',
            'swift_iban' => 'required|string',
        ];
    }
}
