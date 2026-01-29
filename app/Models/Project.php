<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'manager_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    public function scopeVisibleTo(Builder $query, User $user): Builder
    {
        if ($user->isManager()) {
            return $query;
        }

        return $query->whereHas('issues', function (Builder $issues) use ($user) {
            $issues->where('assignee_id', $user->id);
        });
    }

    public function isVisibleTo(User $user): bool
    {
        if ($user->isManager()) {
            return true;
        }

        return $this->issues()->where('assignee_id', $user->id)->exists();
    }
}
