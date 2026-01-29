<?php

declare(strict_types=1);

namespace App\Repositories\Issue;

use App\Repositories\AbstractCriteria;

class IssueCriteria extends AbstractCriteria
{
    public function __construct(
        ?string $search = null,
        ?string $sort_column = null,
        ?string $sort_order = null,
        ?int $per_page = null,
        public ?string $status = null,
        public ?string $type = null,
        public ?int $priority = null,
        public ?int $project_id = null,
        public ?int $assignee_id = null,
    ) {
        parent::__construct($search, $sort_column, $sort_order, $per_page);
        $this->status = $status;
        $this->type = $type;
        $this->priority = $priority;
        $this->project_id = $project_id;
        $this->assignee_id = $assignee_id;
    }
}
