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

    public function index(){
        helper(['form', 'url']);
    }

    public function login_action()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            $pass = $user->password;
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'       => $user->id,
                    'name'     => $user->name,
                    'email'    => $user->email,
                    'role'     => $user->role,
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);

                session()->setFlashdata('msg', 'Hola Mundo!');
                return redirect()->to('/commercial');
            }else {
                dd('Contraseña incorrecta', $password, $pass);
                session()->setFlashdata('msg', 'Sos boludo e, le erraste la contraseña pa');
                return redirect()->to('/login');
            } 
        }else{
            session()->setFlashdata('msg', 'Sos boludo e, le erraste al email ahora pa');
            return redirect()->to('/login');
        }
    }

    public function register_action()
    {
        $model = new UserModel();

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'cliente' // por defecto
        ];

        $r = $model->insert($data);

        if ($r)
        {
            echo "Usuario registrado con exito!";
        }
        else
        {
            echo "Error en el registro.";
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
