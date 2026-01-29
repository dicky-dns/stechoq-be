<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\AbstractRepository;
use App\Repositories\CriteriaInterface;

class UserRepository extends AbstractRepository
{
    protected string $model = User::class;

    protected ?array $with = ['roles'];

    protected ?array $searchableColumns = ['name', 'email'];

    protected ?array $sortableColumns = ['name', 'email', 'created_at'];

    protected string $sortColumn = 'name';

    public function __construct(protected ?CriteriaInterface $criteria = null)
    {
        parent::__construct($criteria);
    }

    public function role(string $role): static
    {
        $this->query->where(function ($query) use ($role) {
            $query->where('role', $role)
                ->orWhereHas('roles', function ($query) use ($role) {
                    $query->where('name', $role);
                });
        });

        return $this;
    }

    public function findByEmail(string $email): ?User
    {
        return User::query()->where('email', $email)->first();
    }
}
