<?php

namespace App\Actions\Auth;

use App\Actions\AbstractAction;
use App\Data\LoginData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Login extends AbstractAction
{
    public function __construct(
        protected LoginData $data,
    ) {}

    public function handle(): array
    {
        $user = User::query()->whereEmail($this->data->email)->first();

        if (! $user || ! Hash::check($this->data->password, $user->password)) {
            abort(422, 'Invalid credentials.');
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
