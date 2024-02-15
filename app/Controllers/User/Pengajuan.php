<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\DetailModel;
use App\Models\KelengkapanModel;
use App\Models\MustahikModel;
use App\Models\PermohonanModel;

class Pengajuan extends BaseController
{

    protected $kelengkapan;
    protected $permohonan;
    protected $mustahik;
    protected $detail;
    public function __construct() {
        $this->kelengkapan = new KelengkapanModel();
        $this->permohonan = new PermohonanModel();
        $this->mustahik = new MustahikModel();
        $this->detail = new DetailModel();
    }

    public function index()
    {
        return view('mustahik/pengajuan');
    }

    public function add()
    {
        return view('mustahik/add_pengajuan');
    }

    public function read()
    {
        $data = $this->permohonan->select("permohonan.*")
        ->join("mustahik", "mustahik.id=permohonan.mustahik_id")
        ->where('mustahik.user_id', session()->get("uid"))->findAll();
        return $this->respond($data);
    }

    public function kelengkapan()
    {
        $data = $this->kelengkapan->findAll();
        return $this->respond($data);
    }

    public function post()
    {
        $conn = \Config\Database::connect();
        $mustahik = $this->mustahik->where('user_id', session()->get('uid'))->first();
        $lib = new \App\Libraries\Decode();
        $param = $this->request->getJSON();
        try {
            $conn->transBegin();
            $itemPengajuan = [
                'mustahik_id'=>$mustahik->id,
                'tanggal_pengajuan'=>date("Y-m-d"),
                'status'=>'Pengajuan'
            ];
            $this->permohonan->insert($itemPengajuan);
            $permohonan_id = $this->permohonan->getInsertID();
            foreach ($param as $key => $value) {
                $itemDetail = [
                    'permohonan_id'=>$permohonan_id,
                    'kelengkapan_id'=>$value->id,
                    'file'=> $lib->decodebase64($value->berkas->base64)
                ];
                $this->detail->insert($itemDetail);
            }
            if($conn->transStatus()){
                $conn->transCommit();
                return $this->respondCreated(true);
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
