<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionSchemaPostRequest;
use App\Http\Resources\AuctionSchemaResource;
use App\Models\AuctionScheme;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuctionSchemaController extends Controller
{

    /**
     * @api
     * @method {GET}
     */
    public function get()
    {
        return AuctionSchemaResource::collection(AuctionScheme::all());
    }

    /**
     * @api
     * @method {POST}
     */
    public function create(AuctionSchemaPostRequest $request)
    {
        AuctionScheme::query()->create($request->all());

        return new JsonResponse([
            "message" => "Auction schema creation success."
        ]);
    }
}
