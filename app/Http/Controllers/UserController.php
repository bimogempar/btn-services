<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCreateUser;
use App\Http\Requests\RequestUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers()
    {
        try {
            $users = User::get();
            return $this->buildResponse(200, "Success", compact('users'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
    public function createUser(RequestCreateUser $req)
    {
        try {
            $body = $req->all();
            $body['password'] = Hash::make($body['password']);
            $user = User::create($body);
            return $this->buildResponse(200, "Success", compact('user'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
    public function updateUser(RequestUpdateUser $req)
    {
        try {
            $user = User::where('id', $req->input('id'))->firstOrFail();
            $user->update([
                'name' => $req->input('name', $user->name),
                'email' => $req->input('email', $user->email),
                'password' => Hash::make($req->input('password', $user->password)),
                'role' => $req->input('role', $user->role),
            ]);
            return $this->buildResponse(200, "Success", compact('user'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
    public function deleteUser(Request $req)
    {
        try {
            $user = User::where('email', $req->input('email'))->firstOrFail();
            $user->delete();
            return $this->buildResponse(200, "Success", null);
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
}
