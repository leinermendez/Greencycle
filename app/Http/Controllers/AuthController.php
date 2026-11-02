<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
   public function register(RegisterRequest $request): JsonResponse
    {
        
        $user = User::create($request->validated());

       
        $token = $user->createToken('api')->plainTextToken;

        return (new UserResource($user))
            ->additional(['token' => $token])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    
    public function login(LoginRequest $request): JsonResponse
    {
        
        $user = $request->authenticate();

        $token = $user->createToken('api')->plainTextToken;

        return (new UserResource($user))
            ->additional(['token' => $token])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }


    public function logout(Request $request): JsonResponse
    {
        
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }

   
    public function me(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}


