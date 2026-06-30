<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'service' => [
                'id' => $this->service->id,
                'name' => $this->service->name,
            ],
            'machine_id' => $this->machine_id,
            'qty_or_weight' => $this->qty_or_weight,
            'price_per_unit' => $this->price_per_unit,
            'subtotal' => $this->subtotal,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ];
    }
}
