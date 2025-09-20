<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'order_id' => $this->order_id,
            'customer_id' => $this->customer_id,
            'status' => $this->status,
            'total' => $this->total,
            'channel' => $this->channel,
            'payload' => $this->payload,
            'notified_at' => $this->notified_at,
        ];
    }
}
