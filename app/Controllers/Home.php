<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        if(session()->get('role')=='Peminjam'){
            return view('mustahik/home');
        }
        return view('admin/home');
    }
}
