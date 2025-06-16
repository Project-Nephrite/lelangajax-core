<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
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
        $data = Category::all();

        return CategoryResource::collection($data);
    }

    public function create(Request $request)
    {
        $data = new Category([
            "name" => $request->name,
            "description" => $request->description
        ]);

        $data->save();

        return new JsonResponse([
            "message" => "Category is created"
        ]);
    }
}
