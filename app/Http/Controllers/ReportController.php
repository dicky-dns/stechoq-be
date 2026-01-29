<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\ReportData;
use App\Enums\Permission;
use App\Repositories\Report\ReportCriteria;
use App\Repositories\Report\ReportRepository;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(sprintf('permission:%s', Permission::ReportView->value))->only(['index']);
    }

    public function index(Request $request)
    {
        $repository = new ReportRepository(ReportCriteria::from($request));

        $reports = $request->boolean('paginate')
            ? $repository->paginate($request->all())
            : $repository->get();

        return $this->sendJsonResponse(ReportData::collect($reports));
    }
}
