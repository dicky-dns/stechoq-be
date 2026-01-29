<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Project\SaveProject;
use App\Actions\Project\ShowProject;
use App\Data\ProjectData;
use App\Enums\Permission;
use App\Exceptions\JsonResponseException;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Repositories\Project\ProjectCriteria;
use App\Repositories\Project\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(sprintf('permission:%s', Permission::ProjectView->value))->only(['index', 'show']);
        $this->middleware(sprintf('permission:%s', Permission::ProjectCreate->value))->only(['store']);
    }

    public function index(Request $request)
    {
        $repository = new ProjectRepository(ProjectCriteria::from($request));

        $projects = $request->boolean('paginate')
            ? $repository->paginate($request->all())
            : $repository->get();

        return $this->sendJsonResponse(ProjectData::collect($projects));
    }

    public function show(Project $project)
    {
        try {
            $project = dispatch_sync(new ShowProject($project));

            return $this->sendJsonResponse(ProjectData::from($project));
        } catch (\Throwable $throwable) {
            throw new JsonResponseException($throwable->getMessage(), (int) $throwable->getCode());
        }
    }

    public function store(ProjectRequest $request)
    {
        try {
            dispatch_sync(new SaveProject(new Project, $request->getData()));

            return $this->sendJsonResponse([
                'message' => 'Succesfully save data',
            ]);
        } catch (\Throwable $throwable) {
            throw new JsonResponseException($throwable->getMessage(), (int) $throwable->getCode());
        }
    }
}
