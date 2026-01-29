<?php

namespace App\Data;

use App\Models\User;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $role,
    ) {}

    public static function fromModel(User $user): self
    {
        $role = $user->role ?? $user->getRoleNames()->first() ?? '';

        return new self(
            $user->id,
            $user->name,
            $user->email,
            $role,
        );
    }
}
