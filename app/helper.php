<?php

use App\Services\ResponseService;
use Illuminate\Http\JsonResponse;

if (! function_exists('responder')) {
    function responder(): JsonResponse
    {
        return app(ResponseService::class);
    }
}
