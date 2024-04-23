<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TabunganModel;

class Tabungan extends BaseController
{
    protected $tabungan;
    public function __construct()
    {
        $this->tabungan = new TabunganModel();
    }

    public function index()
    {
        return view('mustahik/infak');
    }


    public function read()
    {
        $data = $this->tabungan->select("tabungan.nominal, jadwal_bayar.tanggal_bayar")
        ->join("jadwal_bayar", "jadwal_bayar.id=tabungan.jadwal_bayar_id")
        ->join("permohonan", "permohonan.id=jadwal_bayar.permohonan_id")
        ->join("mustahik", "mustahik.id=permohonan.mustahik_id")->where('user_id', session()->get('uid'))->findAll();
        return $this->respond($data);
    }
}
