<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class RoleGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();

        if (! $session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión.');
        }

        if ($arguments && !in_array($session->get('user_role'), $arguments)) {
            return redirect()->to('/')->with('error', 'No tienes permisos para acceder.');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
