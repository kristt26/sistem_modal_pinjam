<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        if(session()->get('role')=='Peminjam'){
            return view('layout/user/layout');
        }
        return view('layout/admin/layout');
    }
}
