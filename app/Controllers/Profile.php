<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function view()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        return view('profile/view', ['user' => $user]);
    }

    public function edit()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        return view('profile/edit', ['user' => $user]);
    }

    

    public function update(){
        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $data = [
            'name'  => $name,
            'email' => $email
        ];

        if (!empty($currentPassword) || !empty($newPassword) || !empty($confirmPassword)) {
            if (empty($currentPassword) || !password_verify($currentPassword, $user['password'])) {
                return redirect()->back()->withInput()->with('error', 'La contraseña actual es incorrecta.');
            }
        
            if ($newPassword !== $confirmPassword) {
                return redirect()->back()->withInput()->with('error', 'Las nuevas contraseñas no coinciden.');
            }
        
            if (strlen($newPassword) < 6) {
                return redirect()->back()->withInput()->with('error', 'La nueva contraseña debe tener al menos 6 caracteres.');
            }
        
            $data['password'] = $newPassword;
        }

        $userModel->update($userId, $data);

        return redirect()->to('/profile')->with('success', 'Perfil actualizado correctamente.');
    }
}
