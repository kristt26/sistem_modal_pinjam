<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DetailModel;
use App\Models\KelengkapanModel;
use App\Models\PermohonanModel;

class Permohonan extends BaseController
{

    protected $kelengkapan;
    protected $permohonan;
    protected $detail;
    public function __construct() {
        $this->kelengkapan = new KelengkapanModel();
        $this->permohonan = new PermohonanModel();
        $this->detail = new DetailModel();
    }

    public function index()
    {
        return view('admin/permohonan');
    }

    public function read($status = null)
    {
        $data = $this->permohonan->select("permohonan.*, mustahik.nama, mustahik.nik, mustahik.kontak, mustahik.alamat")
        ->join('mustahik', 'mustahik.id=permohonan.mustahik_id')
        ->where('status', $status)->findAll();
        foreach ($data as $key => $value) {
            $value->detail = $this->detail->select("detail.*, kelengkapan.kelengkapan")
            ->join('kelengkapan', 'kelengkapan.id=detail.kelengkapan_id')
            ->where('permohonan_id', $value->id)->findAll();
        }
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
            if($this->permohonan->update($param->id, $param)) return $this->respondUpdated(true);
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
