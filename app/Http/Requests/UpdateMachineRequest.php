<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMachineRequest extends FormRequest
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
            'key' => ['required', 'string', 'max:50', 'unique:machines,key'],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:washer,dryer'],
            'status' => ['nullable', 'in:idle,running,maintenance,offline'],
        ];
    }
}
