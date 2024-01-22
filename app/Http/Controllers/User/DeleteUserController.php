<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;

class DeleteUserController extends Controller
{
    public function __invoke($id, UserService $userService){

        return view('user.index', ['users' => $userService->deleteUser($id)]);
    }
}
