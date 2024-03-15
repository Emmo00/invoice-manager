<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInvoiceRequest extends FormRequest
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
            "customerId" => ["required"],
            "amount" => ["required", "integer"],
            "status" => ["required", Rule::in(['V', 'B', 'P'])],
            "billed_date" => ["required"],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "customer_id" => $this->customerId,
            "billed_date" => $this->billedDate,
            "paid_date" => $this->paidDate,
        ]);
    }
}
