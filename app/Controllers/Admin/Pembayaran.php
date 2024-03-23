<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InfakModel;
use App\Models\JadwalModel;

class Pembayaran extends BaseController
{

    protected $jadwal;
    protected $infak;
    public function __construct() {
        $this->jadwal = new JadwalModel();
        $this->infak = new InfakModel();
    }

    public function index()
    {
        return view('admin/pembayaran');
    }

    public function read()
    {
        $data = $this->jadwal->select("jadwal_bayar.*, mustahik.nama, permohonan.kode")
        ->join("permohonan", "permohonan.id=jadwal_bayar.permohonan_id")
        ->join("mustahik", "mustahik.id=permohonan.mustahik_id")
        ->where('jadwal_bayar.status', 'Pengajuan')->findAll();
        return $this->respond($data);
    }

    // public function post()
    // {
    //     $conn = \Config\Database::connect();
    //     $param = $this->request->getJSON();
    //     try {
    //         $conn->transBegin();
    //         $this->kelengkapan->insert($param);
    //         $param->id = $this->kelengkapan->getInsertID();
    //         if($conn->transStatus()){
    //             $conn->transCommit();
    //             return $this->respondCreated($param);
    //         }
    //     } catch (\Throwable $th) {
    //         $conn->transRollback();
    //         $this->fail($th->getMessage());
    //     }
    // }

    public function put()
    {
        $conn = \Config\Database::connect();
        $param = $this->request->getJSON();
        try {
            $conn->transBegin();
            if($param->bayar>$param->tagihan){
                $infak = ['nominal'=>$param->bayar-$param->tagihan, 'jadwal_bayar_id'=>$param->id];
                $this->infak->insert($infak);
                $param->bayar = $param->bayar - $infak['nominal'];
            }
            $this->jadwal->update($param->id, $param);
            if($conn->transStatus()){
                $conn->transCommit();
                return $this->respondUpdated(true);
            }else{
                throw new \Exception("Gagal simpan", 1);
                
            }
        } catch (\Throwable $th) {
            $conn->transRollback();
            $this->fail($th->getMessage());
        }
    }
    
    // public function delete($id=null)
    // {
    //     try {
    //         if($this->jadwal->delete($id)) return $this->respondDeleted(true);
    //     } catch (\Throwable $th) {
    //         $this->fail($th->getMessage());
    //     }
    // }
}
