<?php

declare(strict_types=1);

namespace App\Actions\Project;

use App\Actions\AbstractAction;
use App\Data\ProjectData;
use App\Enums\ProjectStatus;
use App\Exceptions\ProjectException;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class SaveProject extends AbstractAction
{
    public function __construct(
        private readonly Project $project,
        private readonly ProjectData $data,
    ) {}

    public function handle(): void
    {
        /** @var ?User $user */
        $user = Auth::user();
        throw_if(! $user, AuthenticationException::class);
        throw_if(! $user->isManager(), ProjectException::class, 'Only managers can manage projects');

        if ($this->project->id) {
            throw_if($this->project->manager_id !== $user->id, ProjectException::class, 'Only the owning manager can update this project');
        }

        $this->project->fill([
            'name' => $this->data->name,
            'manager_id' => $this->project->id ? $this->project->manager_id : $user->id,
            'start_date' => $this->data->start_date,
            'end_date' => $this->data->end_date,
            'status' => $this->data->status ?? ProjectStatus::NotStarted->value,
        ]);

        $this->project->save();
    }
}
