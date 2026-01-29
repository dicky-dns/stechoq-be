<?php

namespace App\Repositories\Project;

use App\Models\Project;
use App\Models\User;
use App\Repositories\AbstractRepository;
use App\Repositories\CriteriaInterface;
use Illuminate\Support\Facades\Auth;

class ProjectRepository extends AbstractRepository
{
    protected string $model = Project::class;

    protected ?array $with = ['manager'];

    protected ?array $searchableColumns = ['name'];

    protected ?array $sortableColumns = ['name', 'start_date', 'end_date', 'status', 'created_at'];

    protected string $sortColumn = 'id';

    public function __construct(protected ?CriteriaInterface $criteria = null)
    {
        parent::__construct($criteria);

        $user = Auth::user();

        if ($user instanceof User) {
            $this->query->visibleTo($user);
        }
    }

    public function status(string $status): static
    {
        $this->query->where('status', $status);

        return $this;
    }
}
