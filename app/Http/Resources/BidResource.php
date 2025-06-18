<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "index" => $this->index,
            "timestamp" => $this->created_at,
            "value" => $this->value,
            "user_id" => $this->user_id,
            "listing_id" => $this->listing_id

        ];
    }
}
