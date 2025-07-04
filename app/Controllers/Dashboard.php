<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('user_role'), ['admin', 'vendedor'])) {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }

        return view('dashboard/home');
    }
}
