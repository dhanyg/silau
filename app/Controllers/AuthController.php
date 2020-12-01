<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->User = new User();
    }
    public function login()
    {
        $session_id = session('id');
        $session_name = session('name');
        $session_role = session('role');
        if ($session_id and $session_name and $session_role) {
            return redirect()->to('/dashboard');
        }
        $data['title'] = 'Login Page';
        $data['validation'] = \Config\Services::validation();
        return view('auth/login', $data);
    }

    public function auth()
    {
        if (!$this->validate([
            'username' => 'required',
            'password' => [
                'rules' => 'required|min_length[4]',
                'label' => 'password'
            ]
        ])) {
            return redirect()->to('/')->withInput();
        }
        // dd($this->request->getPost());
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $findUser = $this->User->where('username', $username)->first();
        if (!$findUser) {
            session()->setFlashdata('error', 'User doesn\'t exist');
            return redirect()->to('/')->withInput();
        } else {
            $passwordCheck = password_verify($password, $findUser['password']);
            if (!$passwordCheck) {
                session()->setFlashdata('error', 'Invalid password');
                return redirect()->to('/')->withInput();
            } else {
                $session_data = [
                    'id' => $findUser['id'],
                    'name' => $findUser['display_name'],
                    'role' => $findUser['role_id']
                ];
                session()->set($session_data);
                return redirect()->to('/dashboard');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to('/');
    }

    public function blocked()
    {
        $data['title'] = '403 - Restricted';
        return view('auth/403', $data);
    }

    public function notfound()
    {
        $data['title'] = '404 - Not Found';
        return view('auth/404', $data);
    }

    //--------------------------------------------------------------------

}
