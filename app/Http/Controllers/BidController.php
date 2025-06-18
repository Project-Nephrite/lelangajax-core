<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidPostRequest;
use App\Http\Resources\BidResource;
use App\Models\Bid;
use App\Models\Listing;
use Illuminate\Http\Request;

class BidController extends Controller
{

    public function createBid(BidPostRequest $request)
    {
        $new = new Bid($request->validated());
        $new->user_id = $request->user_id;

        $list = Listing::query()->where('id', $request->listing_id)->increment("value_current", $request->value);

        if ($new->saveOrFail()) return 200;
        else return 400;
    }

    public function getBids(Request $request)
    {
        $param = $request->query("id");

        return BidResource::collection(Bid::query()->where("listing_id", $param)->get()->all());
    }

    public function myBids(Request $request)
    {
        $id = $request->user()->id;

        return BidResource::collection(Bid::query()->where('user_id', $id)->get()->all());
    }
}
