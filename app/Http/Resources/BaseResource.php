<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{

    public function withResource(Request $request, JsonResponse $response)
    {
        $response->setData([
            'status' => true,
            'message' => "Success",
            'data' => $request->getPayload(),
        ]);
    }
}
