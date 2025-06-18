<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\StoragePathManager;
use App\Services\StorageService;
use App\Shared\Storage\Filepaths\StorageFilepath;
use App\Shared\storage\Filepaths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request, StoragePathManager $path, StorageService $storage)
    {
        $validated = $request->validate([
            'username'      =>  'required|string|unique:users|max:255',
            'email'         =>  'required|string|email|max:255|unique:users',
            'password'      =>  'required|string|min:8',
            'first_name'    =>  'required|string',
            'last_name'     =>  'required|string',
            'address'       =>  'required|string',
            'email_alt'     =>  'string|email',
            'phone'         =>  'required|string',
            'nik'           =>  'string',
            'birth_of_date' =>  'required|string',
            'home_address'  =>  'string',
            'profile'       =>  'file',
            'ktp'           =>  'file',
            'verification_key'  => 'string'
        ]);

        $pathProfile = $storage->upload(
            $path->userPicturePath(),
            $request->file('profile')
        );
        $pathKtp = $storage->upload($path->userKtpPath(), $request->file('ktp'));

        $user = User::query()->create([
            'username'      =>  $validated['username'],
            'email'         =>  $validated['email'],
            'password'      =>  Hash::make($validated['password']),
            'first_name'    =>  $validated['first_name'],
            'last_name'     =>  $validated['last_name'],
            'address'       =>  $validated['address'],
            'email_alt'     =>  $validated['email_alt'],
            'phone'         =>  $validated['phone'],
            'nik'           =>  $validated['nik'],
            'birth_of_date' =>  $validated['birth_of_date'],
            'home_address'  =>  $validated['home_address'],
            'ktp_url'       =>  Storage::disk('azure')->path($pathKtp),
            'profile_url'   => Storage::disk('azure')->path($pathProfile),
            'verification_key' => $validated['verification_key']
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Login a user and return token
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::query()->where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email or password is invalid'],
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    /**
     * Logout the user (revoke tokens)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }

    /**
     * Get the authenticated user
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
