<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MustahikModel;
use App\Models\UserModel;

class Mustahik extends BaseController
{

    protected $mustahik;
    protected $user;
    public function __construct() {
        $this->mustahik = new MustahikModel();
        $this->user = new UserModel();
    }

    public function index()
    {
        return view('admin/mustahik');
    }

    public function read()
    {
        $data = $this->mustahik->findAll();
        return $this->respond($data);
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

    public function put()
    {
        $param = $this->request->getJSON();
        try {
            if($this->mustahik->update($param->id, $param)) return $this->respondUpdated(true);
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }
    }
    
    public function delete($id=null)
    {
        try {
            if($this->mustahik->delete($id)) return $this->respondDeleted(true);
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }
    }
}
