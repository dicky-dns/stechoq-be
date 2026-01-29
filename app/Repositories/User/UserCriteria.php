<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Repositories\AbstractCriteria;

class UserCriteria extends AbstractCriteria
{
    public function __construct(
        ?string $search = null,
        ?string $sort_column = null,
        ?string $sort_order = null,
        ?int $per_page = null,
        public ?string $role = null,
    ) {
        parent::__construct($search, $sort_column, $sort_order, $per_page);
        $this->role = $role;
    }
}
