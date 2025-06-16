<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingPostRequest;
use App\Http\Requests\ListingUpdateRequest;
use App\Http\Resources\ListingResource;
use App\Models\Listing;
use App\Services\StoragePathManager;
use App\Services\StorageService;
use App\Shared\Enums\ListingStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    private StoragePathManager $pathManager;
    /**
     * @api
     * @method {POST}
     */
    public function create(ListingPostRequest $request, StorageService $upload)
    {
        $new = new Listing($request->all());
        $new->value_current = $request->value_base;
        $new->status = ListingStatusEnum::Open->value;
        $new->seller_id = $request->user()->id;


        $urls = [];
        $this->pathManager = new StoragePathManager('uploads');

        if ($new['bucket_url']) {
            foreach ($new->bucket_url as $url) {

                Storage::disk('azure')->delete($url);
            }
        }
        $files = $request->file('images');
        foreach ($files as $file) {
            $filepath = $this->pathManager->listingPath();
            $urls[] = $upload->upload($filepath, $file);
        };

        $new->bucket_url = $urls;


        $new->save();

        return new JsonResponse([
            "message" => "Creation success",
            "data" => $new

        ]);
    }

    /**
     * @api
     * @method {GET}
     */
    public function myLists(Request $request)
    {
        $user = $request->user();
        $data = Listing::query()->where('seller_id', $user->id)->get();
        return ListingResource::collection($data);
    }

    /**
     * @api
     * @method {GET}
     * get one list with id
     */
    public function detail(Request $request)
    {
        $param = $request->query("id");
        $record = Listing::query()->findOrFail($param);
        return new ListingResource($record);
    }


    /**
     * @api
     * @method {GET}
     * @param {string} q - query param for search keywords
     */
    public function search(Request $request)
    {
        $keyword = $request->query('q');

        if (!$keyword) {
            return ListingResource::collection(Listing::query()->paginate(15));
        };
        $results = Listing::query()->whereAny(['name', 'description'], 'like', $keyword . '%')->paginate(15);

        return ListingResource::collection($results);
    }


    /**
     * @api
     * @method {PUT}
     * Updates current list
     */
    public function update(ListingUpdateRequest $request)
    {
        $id = $request->id;
        $record = Listing::query()->findOrFail($id);

        $record->update($request->all());
        return new ListingResource($record);
    }
}
