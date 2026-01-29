<?php

declare(strict_types=1);

namespace App\Actions\Project;

use App\Actions\AbstractAction;
use App\Data\ProjectData;
use App\Domains\User\Models\User;
use App\Enums\ProjectStatus;
use App\Models\Project;
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

        $this->project->fill([
            'name' => $this->data->name,
            'manager_id' => $user->id,
            'start_date' => $this->data->start_date,
            'end_date' => $this->data->end_date,
            'status' => $this->data->status ?? ProjectStatus::NotStarted->value,
        ]);

        $this->project->save();
    }
}
