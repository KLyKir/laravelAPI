<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return User::get();
    }

    public function updateUser($data, $id){
        $user = User::query()->find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();
        return $user;
    }

    public function insertUser($data){
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 1
        ]);
        return $user;
    }
}
