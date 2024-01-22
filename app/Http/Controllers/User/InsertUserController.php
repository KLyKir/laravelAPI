<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Request;

class InsertUserController extends Controller
{
    public function index(){

        return view('user.add_update');
    }

    public function insert(\Illuminate\Http\Request $request){
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'string', 'unique:users'],
            'password' => ['required']
        ]);
        if($data){
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->role_id = 1;
            $user->save();
            $users = User::get();
            return view('user.index', ['users' => $users]);
        }
    }
}
