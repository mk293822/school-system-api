<?php

namespace App\Identity\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Identity\Application\UseCases\RegisterUser;
use App\Identity\Http\Requests\LoginRequest;
use App\Identity\Http\Requests\RegisterRequest;
use App\Identity\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(RegisterRequest $request, RegisterUser $useCase)
    {
        $user = $useCase->execute($request->toDto());

        return ApiResponse::success(UserResource::make($user));
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $user = $request->user();
        $isMobile = $request->header('X-Platform') === 'mobile';

        $token = $isMobile
            ? $user->createToken('mobile-auth')->plainTextToken
            : null;

        if (! $isMobile) {
            $request->session()->regenerate();
        }

        return ApiResponse::success([
            'user' => UserResource::make($user),
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $isMobile = $request->header('X-Platform') === 'mobile';

        if ($isMobile) {
            $request->user()->tokens()->delete();
        } else {
            Auth::logout();
            $request->session()?->invalidate();
            $request->session()?->regenerateToken();
        }

        return ApiResponse::success();
    }
}
