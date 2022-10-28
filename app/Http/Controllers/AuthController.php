<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\AuthService;
use App\Transformers\Auth\MemberResource;
class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());

        return responder()->getSuccess();
    }

    public function info(Request $request): JsonResponse
    {
        $resource = new MemberResource($request->user());

        return responder()->getSuccess($resource);
    }

    public function register(Request $request): JsonResponse
    {

    }
}
