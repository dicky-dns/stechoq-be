<?php

declare(strict_types=1);

namespace App\Enums;

enum Permission: string
{
    case UserView = 'user.view';
    case ProjectView = 'project.view';
    case ProjectCreate = 'project.create';
    case IssueView = 'issue.view';
    case IssueCreate = 'issue.create';
    case IssueUpdate = 'issue.update';
    case ReportView = 'report.view';
}
