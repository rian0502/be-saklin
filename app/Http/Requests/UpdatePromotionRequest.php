<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePromotionRequest extends FormRequest
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
        $promotion = $this->route('promotion');

        return [
            'code' => [
                'sometimes', 'required', 'string', 'max:50',
                Rule::unique('promotions', 'code')->ignore($promotion->id),
            ],
            'discount_type' => ['sometimes', 'required', 'string', 'in:percentage,nominal'],
            'value' => ['sometimes', 'required', 'numeric', 'min:0'],
            'valid_from' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'status' => ['nullable', 'string', 'in:active,inactive,expired'],
        ];
    }
}
