<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register(){
        return view('auth.register_form');
    }

    public function store(RegistrationForm $request, UserService $userService){
        $data = $request->validated();

        if($user = $userService->insertUser($data)){
            Auth::guard('web')->login($user);
        }
        return redirect()->route('home');
    }
}
