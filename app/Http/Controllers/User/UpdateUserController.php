<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    public function index($id){
        $user = User::findOrFail($id);
        return view('user.add_update', ['user' => $user]);
    }

    public function update(Request $request, UserService $userService){
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'string'],
            'password' => ['required']
        ]);
        if($userService->updateUser($data, $request->id)){
            $users = User::get();
            return view('user.index', ['users' => $users]);
        }
    }

}
