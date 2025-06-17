<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function showLogin()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/')->with('error', 'Acceso no autorizado');
        }
        return view('auth/login');
    }

    public function showRegister()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/')->with('error', 'Acceso no autorizado');
        }
        return view('auth/register');
    }

    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/')->with('error', 'Acceso no autorizado');
        }
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', ['validation' => $this->validator]);
        }

        $model = new UserModel();
        $model->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        return redirect()->to('/login')->with('success', 'Registro exitoso');
    }

    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/')->with('error', 'Acceso no autorizado');
        }
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'user_role' => $user['role'],
                'logged_in' => true,
            ]);
            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Credenciales inválidas');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
