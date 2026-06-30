<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOutletRequest extends FormRequest
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
        $outletId = $this->route('outlet')->id;

        return [
            'tenant_id' => ['sometimes', 'exists:tenants,id'],
            'key' => ['sometimes', 'string', 'max:50', 'unique:outlets,key,'.$outletId],
            'name' => ['sometimes', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['nullable', 'in:active,inactive'],
        ];
    }
}
