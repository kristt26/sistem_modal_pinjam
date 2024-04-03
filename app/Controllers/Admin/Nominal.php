<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NominalModel;

class Nominal extends BaseController
{

    protected $nominal;
    public function __construct() {
        $this->nominal = new NominalModel();
    }

    public function index()
    {
        return view('admin/nominal');
    }

    public function read()
    {
        $data = $this->nominal->findAll();
        return $this->respond($data);
    }

    public function post()
    {
        $conn = \Config\Database::connect();
        $param = $this->request->getJSON();
        try {
            $conn->transBegin();
            $this->nominal->insert($param);
            $param->id = $this->nominal->getInsertID();
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
            if($this->nominal->update($param->id, $param)) return $this->respondUpdated(true);
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }
    }
    
    public function delete($id=null)
    {
        try {
            if($this->nominal->delete($id)) return $this->respondDeleted(true);
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }
    }
}
