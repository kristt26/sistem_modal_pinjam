<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Libraries\Decode;
use App\Models\JadwalModel;
use App\Models\PermohonanModel;

class Angsuran extends BaseController
{

    protected $permohonan;
    protected $detail;
    protected $jadwal;
    protected $lib;
    public function __construct()
    {
        $this->permohonan = new PermohonanModel();
        $this->jadwal = new JadwalModel();
        $this->lib = new Decode();
    }

    public function index()
    {
        return view('mustahik/angsuran');
    }

    public function add()
    {
        return view('mustahik/add_pengajuan');
    }
    public function detail($id=null)
    {
        return view('mustahik/detail');
    }

    public function read()
    {
        $data = $this->permohonan->select("permohonan.*, mustahik.nama, mustahik.nik, mustahik.kontak, mustahik.alamat, mustahik.nomor, nominal.nominal")
            ->join('mustahik', 'mustahik.id=permohonan.mustahik_id')
            ->join('nominal', 'nominal.id=permohonan.nominal_id')
            ->where('mustahik.user_id', session()->get("uid"))
            ->where('tahapan', 'Diterima')
            ->findAll();
        return $this->respond($data);
    }

    public function jadwal($id = null)
    {
        $data = $this->jadwal->where('permohonan_id', $id)->findAll();
        return $this->respond($data);
    }

    public function put()
    {
        $param = $this->request->getJSON();
        try {
            $param->bukti = $this->lib->decodebase64($param->berkas->base64);
            $param->status = "Pengajuan";
            $this->jadwal->update($param->id, $param);
            return $this->respondUpdated(true);
        } catch (\Throwable $th) {
            return $this->fail($th->getMessage());
        }
    }
}
