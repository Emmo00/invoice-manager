<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return request()->user()->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() === "PUT") {
            return [
                "customerId" => ["required"],
                "amount" => ["required", "integer"],
                "status" => ["required", Rule::in(['V', 'B', 'P'])],
                "billedDate" => ["required"],
            ];
        } else {
            return [
                "customerId" => ["sometimes", "required"],
                "amount" => ["sometimes", "required", "integer"],
                "status" => ["sometimes", "required", Rule::in(['V', 'B', 'P'])],
                "billedDate" => ["sometimes", "required"],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->customerId) {
            $this->merge([
                "customer_id" => $this->customerId,
            ]);
        }
        if ($this->billedDate) {
            $this->merge([
                "billed_date" => $this->billedDate,
            ]);
        }
        if ($this->paidDate) {
            $this->merge([
                "paid_date" => $this->paidDate,
            ]);
        }
    }
}
