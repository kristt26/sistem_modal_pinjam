<?php

namespace App\Controllers;

use App\Models\MustahikModel;
use App\Models\UserModel;

class Auth extends BaseController
{

    protected $user;
    protected $mustahik;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->mustahik = new MustahikModel();
    }

    public function index(): string
    {
        if ($this->user->countAllResults() == 0) {
            $this->user->insert(['username' => 'Administrator', 'password' => password_hash('Administrator#1', PASSWORD_DEFAULT), 'role' => 'Ketua']);
        }
        return view('login');
    }

    public function register(): string
    {
        return view('register');
    }

    public function post()
    {
    }

    public function login(): object
    {
        $data = $this->request->getJSON();
        $q = $this->user->where('username', $data->username)->first();
        if ($q) {
            if (password_verify($data->password, $q->password)) {
                if($q->role == "Peminjam"){
                    $mustahik = $this->mustahik->where('user_id', $q->id)->first();
                    session()->set(['uid'=>$q->id,'nama' => $mustahik->nama, 'role'=>$q->role, 'isRole' => true]);
                }else{
                    session()->set(['uid'=>$q->id,'nama' => $q->role, 'role'=>$q->role, 'isRole' => true]);
                }
                return $this->respond(true);
            } else return $this->fail("Password salah");
        } else return $this->fail("Username tidak ditemukan");
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth'));
    }
}
