<?php

declare(strict_types=1);

namespace App\Repositories\Project;

use App\Repositories\AbstractCriteria;

class ProjectCriteria extends AbstractCriteria
{
    public function __construct(
        ?string $search = null,
        ?string $sort_column = null,
        ?string $sort_order = null,
        ?int $per_page = null,
        public ?string $status = null,
    ) {
        parent::__construct($search, $sort_column, $sort_order, $per_page);
        $this->status = $status;
    }
}
