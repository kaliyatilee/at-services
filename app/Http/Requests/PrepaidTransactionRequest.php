<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrepaidTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        $rules = [
            'name' => 'required|string|min:3|max:50',
            'phone' => 'required|string|min:10|max:15|regex:/^\d{10,12}$/',
            'currency_id' => 'required',
            'rate' => 'required|min:0.01|max:99999',
            'amount' => 'required|min:0.01|max:99999',
            'description' => 'required|string|min:5|max:255',
            'notes' => 'required|string|min:5|max:255',
            'transaction_date' => 'required|date',
        ];

        return $rules;
    }
}
