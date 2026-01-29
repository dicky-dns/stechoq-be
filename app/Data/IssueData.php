<?php

namespace App\Data;

use App\Models\Issue;
use Spatie\LaravelData\Data;

class IssueData extends Data
{
    public function __construct(
        public ?int $id,
        public ?int $project_id,
        public ?string $title,
        public ?string $description,
        public ?string $type,
        public ?string $status,
        public ?int $priority,
        public float|int|null $working_hour,
        public ?int $assignee_id,
        public ?UserData $assignee,
    ) {}

    public static function fromModel(Issue $issue): self
    {
        return new self(
            $issue->id,
            $issue->project_id,
            $issue->title,
            $issue->description,
            $issue->type,
            $issue->status,
            $issue->priority,
            (float) $issue->working_hour,
            $issue->assignee_id,
            $issue->relationLoaded('assignee') && $issue->assignee ? UserData::fromModel($issue->assignee) : null,
        );
    }
}
