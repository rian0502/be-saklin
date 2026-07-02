<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:50', 'unique:promotions,code'],
            'discount_type' => ['required', 'string', 'in:percentage,nominal'],
            'value' => ['required', 'numeric', 'min:0'],
            'valid_from' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'status' => ['nullable', 'string', 'in:active,inactive,expired'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->discount_type === 'percentage' && $this->value !== null) {
            $this->merge([
                'value' => min((float) $this->value, 100),
            ]);
        }
    }
}
