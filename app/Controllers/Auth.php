<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginAction()
    {
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            $session->set([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role,
                'isLoggedIn' => true
            ]);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Email o contraseña incorrectos');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerAction()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]|max_length[150]'
        ];
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'cliente', // Rol predeterminado para nuevos usuarios
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($userModel->insert($data)) {
            return redirect()->to('/login')->with('success', 'Registro exitoso. Por favor, inicie sesión.');
        } else {
            return redirect()->back()->with('error', 'Error al registrar el usuario');
        }
    }
}