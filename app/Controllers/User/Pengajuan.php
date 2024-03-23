<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Libraries\Decode;
use App\Models\DetailModel;
use App\Models\KelengkapanModel;
use App\Models\MustahikModel;
use App\Models\NominalModel;
use App\Models\PermohonanModel;

class Pengajuan extends BaseController
{

    protected $kelengkapan;
    protected $permohonan;
    protected $mustahik;
    protected $detail;
    protected $nominal;
    protected $lib;
    public function __construct()
    {
        $this->kelengkapan = new KelengkapanModel();
        $this->permohonan = new PermohonanModel();
        $this->mustahik = new MustahikModel();
        $this->detail = new DetailModel();
        $this->nominal = new NominalModel();
        $this->lib = new Decode();
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
        $data = $this->permohonan->select("permohonan.*, mustahik.nama, mustahik.nik, mustahik.kontak, mustahik.alamat, mustahik.nomor, nominal.nominal")
            ->join('mustahik', 'mustahik.id=permohonan.mustahik_id')
            ->join('nominal', 'nominal.id=permohonan.nominal_id')
            ->where('mustahik.user_id', session()->get("uid"))->findAll();
        foreach ($data as $key => $value) {
            $value->detail = $this->detail->select("detail.*, kelengkapan.kelengkapan")
                ->join('kelengkapan', 'kelengkapan.id=detail.kelengkapan_id')
                ->where('permohonan_id', $value->id)->findAll();
        }
        return $this->respond($data);
    }

    public function kelengkapan()
    {
        $data['kelengkapan'] = $this->kelengkapan->findAll();
        $data['nominal'] = $this->nominal->findAll();
        $data['mustahik'] = $this->mustahik->where('user_id', session()->get('uid'))->first();
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
                'kode' => 'pjm-'.$this->lib->random_strings(6),
                'mustahik_id' => $mustahik->id,
                'tanggal_pengajuan' => date("Y-m-d"),
                'status' => 'Diajukan',
                'tahapan' => 'Pengajuan',
                'waktu' => $param->waktu,
                'nominal_id' => $param->nominal_id,
            ];
            $this->permohonan->insert($itemPengajuan);
            $permohonan_id = $this->permohonan->getInsertID();
            foreach ($param->kelengkapan as $key => $value) {
                $itemDetail = [
                    'permohonan_id' => $permohonan_id,
                    'kelengkapan_id' => $value->id,
                    'file' => $lib->decodebase64($value->berkas->base64)
                ];
                $this->detail->insert($itemDetail);
            }

            if ($conn->transStatus()) {
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
            if ($this->kelengkapan->update($param->id, $param)) return $this->respondUpdated(true);
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }
    }

    public function delete($id = null)
    {
        try {
            if ($this->kelengkapan->delete($id)) return $this->respondDeleted(true);
        } catch (\Throwable $th) {
            $this->fail($th->getMessage());
        }
    }
}
