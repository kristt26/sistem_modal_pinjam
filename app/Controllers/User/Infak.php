<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\InfakModel;

class Infak extends BaseController
{
    protected $infak;
    public function __construct()
    {
        $this->infak = new InfakModel();
    }

    public function index()
    {
        return view('mustahik/infak');
    }


    public function read()
    {
        $data = $this->infak->select("infak.nominal, jadwal_bayar.tanggal_bayar")
        ->join("jadwal_bayar", "jadwal_bayar.id=infak.jadwal_bayar_id")
        ->join("permohonan", "permohonan.id=jadwal_bayar.permohonan_id")
        ->join("mustahik", "mustahik.id=permohonan.mustahik_id")->where('user_id', session()->get('uid'))->findAll();
        return $this->respond($data);
    }
}
