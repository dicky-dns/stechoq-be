<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    protected function userOrFail(Request $request): User
    {
        $user = $request->user();

        abort_unless($user, 401, 'Unauthenticated.');

        return $user;
    }

    protected function sendJsonResponse(mixed $data, int $status = 200): JsonResponse
    {
        return response()->json($data, $status);
    }
}
