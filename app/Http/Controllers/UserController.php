<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        try {
            return $this->buildResponse(200, "Success", compact('users'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
    public function createUser()
    {
        try {
            return $this->buildResponse(200, "Success", compact('user'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
    public function updateUser()
    {
        try {
            return $this->buildResponse(200, "Success", compact('user'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
    public function deleteUser()
    {
        try {
            return $this->buildResponse(200, "Success", compact('user'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
}
