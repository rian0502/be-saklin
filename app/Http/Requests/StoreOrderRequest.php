<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'customer_id' => ['required', 'exists:customers,id'],
            'promotion_id' => ['nullable', 'exists:promotions,id'],
            'order_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],

            'order_details' => ['required', 'array', 'min:1'],
            'order_details.*.service_id' => ['required', 'exists:services,id'],
            'order_details.*.machine_id' => ['nullable', 'exists:machines,id'],
            'order_details.*.qty_or_weight' => ['required', 'numeric', 'min:0.01'],
            'order_details.*.start_time' => ['nullable', 'date'],
            'order_details.*.end_time' => ['nullable', 'date', 'after_or_equal:order_details.*.start_time'],
        ];
    }
}
