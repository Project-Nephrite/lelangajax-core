<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *  path="/api/user/me",
 *  tags={"Users"},
 *  summary="Get the current user object of current authenticated",
 *
 *
 * )
 */
class UserController extends Controller
{
    /**
     * Get current authenticated user data
     */
    public function me(Request $request)
    {
        $user = $request->user();

        return new UserResource($user);
    }


    public function detail(Request $request)
    {
        $param = $request->query('id');
        return new UserResource(User::query()->findOrFail($param));
    }
}
