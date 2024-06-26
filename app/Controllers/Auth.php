<?php

namespace App\Controllers;

use App\Libraries\Decode;
use App\Models\MustahikModel;
use App\Models\UserModel;

class Auth extends BaseController
{

    protected $user;
    protected $mustahik;
    protected $lib;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->mustahik = new MustahikModel();
        $this->lib = new Decode();
    }

    public function index(): string
    {
        if ($this->user->countAllResults() == 0) {
            $this->user->insert(['username' => 'Administrator', 'password' => password_hash('Administrator#1', PASSWORD_DEFAULT), 'role' => 'Ketua']);
            $this->user->insert(['username' => 'Staf', 'password' => password_hash('Staf#1', PASSWORD_DEFAULT), 'role' => 'Staf']);
        }
        return view('login');
    }

    public function register(): string
    {
        return view('register');
    }

    public function post()
    {
        $conn = \Config\Database::connect();
        $param = $this->request->getJSON();
        try {
            $conn->transBegin();
            $user = [
                'username'=>$param->nik,
                'password'=>password_hash($param->nik, PASSWORD_DEFAULT),
                'role'=>'Peminjam'
            ];
            $this->user->insert($user);
            $param->user_id = $this->user->getInsertID();
            $param->nomor = $this->lib->random_strings(8);
            $this->mustahik->insert($param);
            $param->id = $this->mustahik->getInsertID();
            if($conn->transStatus()){
                $conn->transCommit();
                return $this->respondCreated($param);
            }
        } catch (\Throwable $th) {
            $conn->transRollback();
            $this->fail($th->getMessage());
        }
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
