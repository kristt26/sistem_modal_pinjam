<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DetailModel;
use App\Models\JadwalModel;
use App\Models\KelengkapanModel;
use App\Models\PermohonanModel;

class Permohonan extends BaseController
{

    protected $kelengkapan;
    protected $permohonan;
    protected $detail;
    protected $jadwal;
    public function __construct() {
        $this->kelengkapan = new KelengkapanModel();
        $this->permohonan = new PermohonanModel();
        $this->detail = new DetailModel();
        $this->jadwal = new JadwalModel();
    }

    public function index()
    {
        return view('admin/permohonan');
    }

    public function read($tahapan = null)
    {
        if($tahapan=='Survey') $set =['Survey', 'Diterima'];
        else $set = [$tahapan];
        $data = $this->permohonan->select("permohonan.*, mustahik.nama, mustahik.nik, mustahik.kontak, mustahik.alamat, mustahik.nomor, nominal.nominal")
        ->join('mustahik', 'mustahik.id=permohonan.mustahik_id')
        ->join('nominal', 'nominal.id=permohonan.nominal_id')
        ->whereIn('tahapan', $set)->findAll();
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
        $conn = \Config\Database::connect();
        $param = $this->request->getJSON();
        try {
            $conn->transBegin();
            $k = 0;
            foreach ($param->rincian as $i => $value) {
                $k+=1;
                $day_from = date('j', strtotime("+$k week"));
                $month_from = date('m', strtotime("+$k week -1 day"));
                $year_to = date('Y', strtotime("-$k week"));
                $value->tanggal_jatuh_tempo = "$year_to-$month_from-$day_from";
                $value->permohonan_id = $param->id;
            }
            if($param->tahapan='Diterima'){
                $param->status="Diterima";
                $this->jadwal->insertBatch($param->rincian);
            }
            $this->permohonan->update($param->id, $param);
            if($conn->transStatus()){
                $conn->transCommit();
                return $this->respondUpdated($param);
            }
        } catch (\Throwable $th) {
            $conn->transRollback();
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
