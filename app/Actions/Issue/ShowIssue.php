<?php

namespace App\Actions\Issue;

use App\Actions\AbstractAction;
use App\Exceptions\IssueException;
use App\Models\Issue;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class ShowIssue extends AbstractAction
{
    public function __construct(
        protected Issue $issue,
    ) {}

    public function handle(): Issue
    {
        $user = Auth::user();
        throw_if(! $user, AuthenticationException::class);

        throw_if(! $this->issue->isVisibleTo($user), IssueException::class, 'Cannot access this issue');

        $this->issue->load(['project', 'assignee']);

        return $this->issue;
    }
}
