<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLogin;
use App\Http\Requests\RequestRegister;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(RequestLogin $req)
    {
        try {
            if (!$token = auth()->attempt($req->all())) {
                throw new Exception('Unauthorized');
            }
            return $this->buildResponse(200, 'Success', compact('token'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, 'Internal Server Error', ['error' => $e->getMessage()]);
        }
    }

    public function register(RequestRegister $req)
    {
        try {
            $credential = [
                'name' => $req->input('name'),
                'email' => $req->input('email'),
                'password' => Hash::make($req->input('password')),
            ];
            $user = User::create($credential);
            return $this->buildResponse(200, 'Success', [
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return $this->buildResponse(500, 'Internal Server Error', ['error' => $e->getMessage()]);
        }
    }
}
