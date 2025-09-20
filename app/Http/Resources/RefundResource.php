<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RefundResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'refund_reference' => $this->refund_reference,
            'processed_at' => $this->processed_at,
        ];
    }
}
