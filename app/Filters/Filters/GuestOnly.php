<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class GuestOnly implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();

        if ($session->get('logged_in')) {
            return redirect()->to('/')->with('info', 'Ya tienes una sesión activa.');
        }

        return null; // Permitir acceso
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
