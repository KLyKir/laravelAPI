<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationForm;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll(){
        return new UserCollection(User::all());
    }
    public function getUser($id){
        return new UserResource(User::findOrFail($id));
    }

    public function deleteUser($id, UserService $userService){
        return new UserCollection($userService->deleteUser($id));
    }

    public function updateUser(Request $request, UserService $userService){
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'string'],
            'password' => ['required']
        ]);
        if($userService->updateUser($data, $request->id)){
            $users = User::get();
            return new UserCollection($users);
        }
        else{
            return [
                'error' => 'Something goes wrong'
            ];
        }
    }

    public function insertUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role_id' => 1,
            ]);

            return new UserCollection(User::all());
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error in db: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
}
