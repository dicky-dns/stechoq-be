<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Auth\Login;
use App\Data\UserData;
use App\Exceptions\JsonResponseException;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $data = $request->getData();

            $result = dispatch_sync(new Login($data));

            return $this->sendJsonResponse([
                'user' => UserData::from($result['user']),
                'token' => $result['token'],
            ]);
        } catch (\Throwable $throwable) {
            throw new JsonResponseException($throwable->getMessage(), (int) $throwable->getCode());
        }
    }

    public function logout(Request $request)
    {
        $user = $this->userOrFail($request);

        $user->currentAccessToken()?->delete();

        return $this->sendJsonResponse(['message' => 'Logged out']);
    }
}
