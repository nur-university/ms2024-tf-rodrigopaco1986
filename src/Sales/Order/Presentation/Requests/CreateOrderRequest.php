<?php

namespace Src\Sales\Order\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateOrderRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'patient_id' => 'required|uuid',
            'payment_installments' => 'required|integer',
            'generate_invoice' => 'required|in:0,1',
            'items' => 'required|array',
            'items.*.service_id' => 'required|uuid',
            'items.*.quantity' => 'required|integer',
            'items.*.price' => 'required|numeric',
            'items.*.discount' => 'required|numeric',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
