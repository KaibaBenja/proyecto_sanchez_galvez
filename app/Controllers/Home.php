<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function index(): string
    {
        return view('/front/home');
    }

    public function contact(): string
    {
        return view('/front/contact');
    }

    public function about(): string
    {
        return view('/front/about');
    }

    public function terms(): string
    {
        return view('/front/terms');
    }

    public function commercial(): string
    {
        return view('/front/comercializacion');
    }
}
