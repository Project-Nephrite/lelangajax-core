<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id'            =>  $this->id,
            "name"          =>  $this->name,
            "description"   =>  $this->description
        ];
    }

    /**
     * Return as response
     */
    public function withResponse(Request $request, JsonResponse $response)
    {
        $response->setData([
            'status'    =>  true,
            'message'   =>  'user retrieval success',
            'data'      =>  $request->getPayload()
        ]);
    }
}
