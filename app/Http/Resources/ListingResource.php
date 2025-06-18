<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request,): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "value_base" => $this->value_base,
            "value_current" => $this->value_current,
            "status" => $this->status,
            "bucket_url" => $this->bucket_url,
            "category_id" => $this->category_id,
            "schema_id" => $this->schema_id,
            "seller_id" => $this->seller_id
        ];
    }
}
