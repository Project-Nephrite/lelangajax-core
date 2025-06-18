<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryPostRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\StoragePathManager;
use App\Services\StorageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * @api
     * @method {GET}
     */
    public function get(Request $request)
    {
        if ($request->has('id')) {
            return Category::query()->findOrFail($request->query('id'))->toResource();
        }
        $data = Category::all();

        return CategoryResource::collection($data);
    }

    /**
     * @api
     * @method {POST}
     */
    public function create(CategoryPostRequest $request, StorageService $storage, StoragePathManager $path)
    {
        $data = new Category($request->validated());
        $data->image_url = $storage->upload($path->internalCategoryPath(), $request->file('image'));

        try {

            $data->saveOrFail();
        } catch (Exception $error) {

            return new JsonResponse([
                "message" => $error
            ], 400);
        }

        return new JsonResponse([
            "message" => "Category is created"
        ]);
    }

    /**
     * @api
     * @method {GET}
     */
    public function getById(int $id)
    {
        return new CategoryResource(Category::query()->findOrFail($id));
    }


    /**
     * @api
     * @method {PUT}
     */
    public function update(CategoryPostRequest $request, StorageService $storage, StoragePathManager $path)
    {
        $data = Category::query()->firstWhere('id', $request->query('id'));

        if ($request->has('image')) {

            $storage->delete($data->image_url);

            $data->image_url = $storage->upload($path->internalCategoryPath(), $request->file('image'));
        }

        $data->update($request->validated());
        return new CategoryResource($data);
    }

    public function delete(Request $request)
    {
        Category::query()->findOrFail($request->query('id'))->deleteOrFail();
        return 200;
    }
}
