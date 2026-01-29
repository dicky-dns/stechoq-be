<?php

declare(strict_types=1);

namespace App\Repositories;

interface CriteriaInterface
{
    /** @return array<string, mixed> */
    public function toArray(): array;
}
