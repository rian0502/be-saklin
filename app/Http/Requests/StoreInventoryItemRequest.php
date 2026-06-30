<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryItemRequest extends FormRequest
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
            'outlet_id' => ['required', 'exists:outlets,id'],
            'name' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:20'],
            'unit_cost' => ['required', 'numeric', 'min:0'],
            'current_stock' => ['nullable', 'numeric', 'min:0'],
            'reorder_point' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
