<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                "name" => ["required", "string"],
                "type" => ["required", "string", Rule::in(["I", "B"])],
                "email" => ["required", "email"],
                "address" => ["required", "string"],
                "city" => ["required", "string"],
                "state" => ["required", "string"],
                "postalCode" => ["required", "string"],
                "country" => ["required", "string"],
            ];
        } else {
            return [
                "name" => ["sometimes", "string"],
                "type" => ["sometimes", "string", Rule::in(["I", "B"])],
                "email" => ["sometimes", "email"],
                "address" => ["sometimes", "string"],
                "city" => ["sometimes", "string"],
                "state" => ["sometimes", "string"],
                "postalCode" => ["sometimes", "string"],
                "country" => ["sometimes", "string"],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->postalCode) {
            $this->merge([
                "postal_code" => $this->postalCode
            ]);
        }
    }
}
