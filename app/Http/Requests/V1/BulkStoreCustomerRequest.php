<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreCustomerRequest extends FormRequest
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
            "*.name" => ["required", "string"],
            "*.type" => ["required", "string", Rule::in(["I", "B"])],
            "*.email" => ["required", "email"],
            "*.address" => ["required", "string"],
            "*.city" => ["required", "string"],
            "*.state" => ["required", "string"],
            "*.postalCode" => ["required", "string"],
            "*.country" => ["required", "string"],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];
        foreach ($this->toArray() as $obj) {
            $obj['postal_code'] = $obj['postalCode'] ?? null;

            $data[] = $obj;
        }
        $this->merge($data);
    }
}
