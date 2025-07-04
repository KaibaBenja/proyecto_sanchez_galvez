<?php

namespace App\Controllers;

use App\Models\ConsultaModel;

class Consultas extends BaseController
{
    public function formulario()
    {
        return view('front/contact');
    }

    public function enviar()
    {
        helper(['form']);

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre'  => 'required|min_length[3]',
            'email'   => 'required|valid_email',
            'tel' => 'permit_empty|regex_match[/^[0-9\-\+\s\(\)]+$/]',
            'mensaje' => 'required|min_length[5]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $consultaModel = new ConsultaModel();
        $consultaModel->insert([
            'nombre'  => $this->request->getPost('nombre'),
            'email'   => $this->request->getPost('email'),
            'tel' => $this->request->getPost('tel'),
            'mensaje' => $this->request->getPost('mensaje'),
        ]);

        session()->setFlashdata('success', 'Tu consulta fue enviada con éxito.');
        return redirect()->to('/contact');
    }

    public function adminIndex()
{
    if (!session()->get('logged_in') || session()->get('user_role') !== 'admin') {
        return redirect()->to('/login')->with('error', 'Acceso no autorizado');
    }

    $consultaModel = new ConsultaModel();

    $search = $this->request->getGet('search');
    $sort = $this->request->getGet('sort') ?? 'created_at';
    $direction = strtolower($this->request->getGet('direction')) ?? 'asc';
    $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'asc';
    $query = $consultaModel->orderBy($sort, $direction);

    if (!empty($search)) {
        $query->groupStart()
              ->like('nombre', $search)
              ->orLike('email', $search)
              ->orLike('tel', $search)
              ->orLike('mensaje', $search)
              ->groupEnd();
    }

    $consultas = $query->findAll();

    return view('dashboard/consultas/index', [
        'consultas' => $consultas,
        'search' => $search,
        'sort' => $sort,
        'direction' => $direction,
    ]);
}
}
