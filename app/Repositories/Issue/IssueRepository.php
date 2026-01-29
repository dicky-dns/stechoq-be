<?php

namespace App\Repositories\Issue;

use App\Models\Issue;
use App\Models\User;
use App\Repositories\AbstractRepository;
use App\Repositories\CriteriaInterface;
use Illuminate\Support\Facades\Auth;

class IssueRepository extends AbstractRepository
{
    protected string $model = Issue::class;

    protected ?array $with = ['assignee'];

    protected ?array $searchableColumns = ['title', 'description'];

    protected ?array $sortableColumns = ['priority', 'status', 'type', 'created_at'];

    protected string $sortColumn = 'priority';

    public function __construct(protected ?CriteriaInterface $criteria = null)
    {
        parent::__construct($criteria);

        $user = Auth::user();

        if ($user instanceof User) {
            $this->query->visibleTo($user);
        }
    }

    public function projectId(int $projectId): static
    {
        $this->query->where('project_id', $projectId);

        return $this;
    }

    public function status(string $status): static
    {
        $this->query->where('status', $status);

        return $this;
    }

    public function type(string $type): static
    {
        $this->query->where('type', $type);

        return $this;
    }

    public function priority(int $priority): static
    {
        $this->query->where('priority', $priority);

        return $this;
    }

    public function assigneeId(int $assigneeId): static
    {
        $this->query->where('assignee_id', $assigneeId);

        return $this;
    }

    public function create(array $attributes): Issue
    {
        return Issue::create($attributes);
    }
}
