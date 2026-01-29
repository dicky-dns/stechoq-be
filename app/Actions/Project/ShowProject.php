<?php

declare(strict_types=1);

namespace App\Actions\Project;

use App\Actions\AbstractAction;
use App\Domains\User\Models\User;
use App\Exceptions\ProjectException;
use App\Models\Project;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class ShowProject extends AbstractAction
{
    public function __construct(
        private readonly Project $project,
    ) {}

    public function handle(): Project
    {
        /** @var ?User $user */
        $user = Auth::user();
        throw_if(! $user, AuthenticationException::class);

        $this->project->load([
            'manager',
            'issues',
        ]);

        if (! $user->isManager()) {
            $check = $this->project->issues()->where('assignee_id', $user->id)->count();

            throw_if(! $check, ProjectException::class, 'Cannot access this project');
        }

        return $this->project;
    }
}
