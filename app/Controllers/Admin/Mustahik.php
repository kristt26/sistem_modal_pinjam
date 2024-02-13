<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MustahikModel;

class Mustahik extends BaseController
{

    protected $mustahik;

    public function __construct() {
        $this->mustahik = new MustahikModel();
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
        $param = $this->request->getJSON();
        try {
            if($this->mustahik->insert($param)) return $this->respondCreated($this->mustahik->getInsertID());
        } catch (\Throwable $th) {
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
