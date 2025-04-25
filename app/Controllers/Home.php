<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('/front/home');
    }

    public function sneaker(): string
    {
        return view('/front/sneaker');
    }
}
