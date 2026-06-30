<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddOrderDetailRequest extends FormRequest
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
            'service_id' => ['required', 'exists:services,id'],
            'machine_id' => ['nullable', 'exists:machines,id'],
            'qty_or_weight' => ['required', 'numeric', 'min:0.01'],
            'start_time' => ['nullable', 'date'],
            'end_time' => ['nullable', 'date', 'after_or_equal:start_time'],
        ];
    }
}
