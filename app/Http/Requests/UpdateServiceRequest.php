<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'machine_type_id' => ['nullable', 'exists:machine_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'type' => ['required', 'in:self_service,full_service,addon'],
            'unit' => ['nullable', 'string', 'max:20'],
            'duration_minutes' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'in:active,inactive'],
        ];
    }
}
