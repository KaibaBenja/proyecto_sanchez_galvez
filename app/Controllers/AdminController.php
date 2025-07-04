<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminController extends BaseController
{
    public function manageUsers(){
        if (!session()->get('logged_in') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }

        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('dashboard/users/index', [
            'users' => $users,
            'currentUserId' => session()->get('user_id'),
        ]);
    }

    public function updateRole($id){
        if (!session()->get('logged_in') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }

        $userModel = new UserModel();
        $newRole = $this->request->getPost('role');

        if (in_array($newRole, ['admin', 'vendedor', 'cliente'])) {
            $userModel->update($id, ['role' => $newRole]);
            return redirect()->back()->with('success', 'Rol actualizado');
        }

        return redirect()->back()->with('error', 'Rol inválido');
    }

    public function deleteUser($id){
        if (!session()->get('logged_in') || session()->get('user_role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }

        if (session()->get('user_id') == $id) {
            return redirect()->back()->with('error', 'No puedes eliminarte a ti mismo');
        }

        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->back()->with('success', 'Usuario eliminado');
    }
}
