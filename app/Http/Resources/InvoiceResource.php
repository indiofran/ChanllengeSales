<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'buyer' => [
                'name' => $this->buyer_name,
                'dni' => $this->buyer_dni,
            ],
            'car' => [
                'name' => $this->car->name,
            ],
            'total_price' => $this->total_price,
            'price_per_installment' => $this->price_per_installment
        ];
    }
}
