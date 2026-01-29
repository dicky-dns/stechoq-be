<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
        'project_id',
        'assignee_id',
        'title',
        'description',
        'type',
        'status',
        'priority',
        'working_hour',
    ];

    protected $casts = [
        'working_hour' => 'float',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function scopeVisibleTo(Builder $query, User $user): Builder
    {
        if ($user->isManager()) {
            return $query;
        }

        return $query->where('assignee_id', $user->id);
    }

    public function isVisibleTo(User $user): bool
    {
        return $user->isManager() || $this->assignee_id === $user->id;
    }
}
