<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Issue\SaveIssue;
use App\Actions\Issue\ShowIssue;
use App\Data\IssueData;
use App\Enums\Permission;
use App\Exceptions\JsonResponseException;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Models\Issue;
use App\Repositories\Issue\IssueCriteria;
use App\Repositories\Issue\IssueRepository;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function __construct()
    {
        $this->middleware(sprintf('permission:%s', Permission::IssueView->value))->only(['index', 'show']);
        $this->middleware(sprintf('permission:%s', Permission::IssueCreate->value))->only(['store']);
        $this->middleware(sprintf('permission:%s', Permission::IssueUpdate->value))->only(['update']);
    }

    public function index(Request $request)
    {
        $repository = new IssueRepository(IssueCriteria::from($request));

        $issues = $request->boolean('paginate')
            ? $repository->paginate($request->all())
            : $repository->get();

        return $this->sendJsonResponse(IssueData::collect($issues));
    }

    public function show(Issue $issue)
    {
        try {
            $issue = dispatch_sync(new ShowIssue($issue));

            return $this->sendJsonResponse(IssueData::from($issue));
        } catch (\Throwable $throwable) {
            throw new JsonResponseException($throwable->getMessage(), (int) $throwable->getCode());
        }
    }

    public function store(StoreIssueRequest $request)
    {
        try {
            dispatch_sync(new SaveIssue(new Issue, $request->getData()));

            return $this->sendJsonResponse([
                'message' => 'Succesfully save data',
            ]);
        } catch (\Throwable $throwable) {
            throw new JsonResponseException($throwable->getMessage(), (int) $throwable->getCode());
        }
    }

    public function update(UpdateIssueRequest $request, Issue $issue)
    {
        try {
            dispatch_sync(new SaveIssue($issue, $request->getData()));

            return $this->sendJsonResponse([
                'message' => 'Succesfully update data',
            ]);
        } catch (\Throwable $throwable) {
            throw new JsonResponseException($throwable->getMessage(), (int) $throwable->getCode());
        }
    }
}
