<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data['title'] = 'Home - POS System';
        return view('pages/home', $data);
    }

    public function about()
    {
        $data['title'] = 'About Us - POS System';
        return view('pages/about', $data);
    }
}