<?php

declare(strict_types=1);

namespace App\Actions\Issue;

use App\Actions\AbstractAction;
use App\Data\IssueData;
use App\Enums\IssueStatus;
use App\Exceptions\IssueException;
use App\Models\Issue;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class SaveIssue extends AbstractAction
{
    public function __construct(
        private readonly Issue $issue,
        private readonly IssueData $data,
    ) {}

    public function handle(): void
    {
        /** @var ?User $user */
        $user = Auth::user();
        throw_if(! $user, AuthenticationException::class);

        if (! $this->issue->id) {
            throw_if(! $user->isManager(), IssueException::class, 'Only managers can create issues');

            $project = Project::query()->find($this->data->project_id);
            throw_if(! $project, IssueException::class, 'Invalid project');
            throw_if($project->manager_id !== $user->id, IssueException::class, 'Only the owning manager can create issues');

            $this->issue->fill([
                'project_id' => $this->data->project_id,
                'assignee_id' => $this->data->assignee_id,
                'title' => $this->data->title,
                'description' => $this->data->description,
                'type' => $this->data->type,
                'priority' => $this->data->priority,
                'status' => $this->data->status ?? IssueStatus::Open->value,
            ]);
        }

        if ($this->issue->id) {
            if ($user->isManager() && $this->data->assignee_id) {
                throw_if($this->issue->project->manager_id !== $user->id, IssueException::class, 'Only the owning manager can assign issues');
                throw_if($this->issue->status !== IssueStatus::Open->value, IssueException::class, 'Only open issues can be assigned');

                $this->issue->assignee_id = $this->data->assignee_id;
            }

            if (! $user->isManager()) {
                throw_if($this->issue->assignee_id !== $user->id, IssueException::class, 'Only the assignee can update this issue');

                $this->issue->working_hour = $this->data->working_hour ?? $this->issue->working_hour;
                $this->issue->status = $this->data->status ?? $this->issue->status;
            }
        }

        $this->issue->save();
    }
}
