<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);
        return view('auth/login');
    }

    public function attemptLogin()
    {
        helper(['form']);
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if ($password === $user['password'] || password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'full_name' => $user['full_name'],
                    'isLoggedIn'=> true,
                ];
                $session->set($sessionData);
                return redirect()->to('/customers')->with('success', 'Welcome back, ' . $user['full_name']);
            } else {
                return redirect()->back()->with('error', 'Invalid password.');
            }
        } else {
            return redirect()->back()->with('error', 'Username not found.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully.');
    }
}