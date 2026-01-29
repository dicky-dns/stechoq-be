<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Enums\Permission;
use App\Repositories\User\UserCriteria;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(sprintf('permission:%s', Permission::UserView->value))->only(['index']);
    }

    public function index(Request $request)
    {
        $repository = new UserRepository(UserCriteria::from($request));

        $users = $request->boolean('paginate')
            ? $repository->paginate($request->all())
            : $repository->get();

        return $this->sendJsonResponse(UserData::collect($users));
    }
}
