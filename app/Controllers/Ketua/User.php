<?php

namespace App\Controllers\Ketua;

use App\Controllers\BaseController;
use App\Models\KelengkapanModel;

class User extends BaseController
{

    protected $kelengkapan;
    public function __construct() {
        $this->kelengkapan = new KelengkapanModel();
    }

    public function index()
    {
        return view('admin/kelengkapan');
    }

    public function read()
    {
        $data = $this->kelengkapan->findAll();
        return $this->respond($data);
    }

    public function post()
    {
        $conn = \Config\Database::connect();
        $param = $this->request->getJSON();
        try {
            $conn->transBegin();
            $this->kelengkapan->insert($param);
            $param->id = $this->kelengkapan->getInsertID();
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
            if($this->kelengkapan->update($param->id, $param)) return $this->respondUpdated(true);
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }
    }
    
    public function delete($id=null)
    {
        try {
            if($this->kelengkapan->delete($id)) return $this->respondDeleted(true);
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }
    }
}
