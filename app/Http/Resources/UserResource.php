<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends BaseResource
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
            'username'      =>  $this->username,
            'email'         =>  $this->email,
            'first_name'    =>  $this->first_name,
            'last_name'     =>  $this->last_name,
            'profile_url'   =>  $this->profile_url,
            'phone'         =>  $this->phone,
            'birth_of_date' =>  $this->birth_of_date,
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
