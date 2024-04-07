<?php

namespace App\Controllers;

use App\Libraries\Wa;
use App\Models\KirimModel;
use App\Models\PesanModel;

class Pesan extends BaseController
{
    public function kirim()
    {
        $conn = \Config\Database::connect();
        $pesan = new Wa();
        $kirim = new KirimModel();
        $psn = new PesanModel();
        try {
            $conn->transBegin();
            $cek = $conn->query("SELECT * FROM kirim_pesan WHERE DATE(tanggal) = date(CURDATE())")->getNumRows();
            if($cek==0){
                $kirim->insert(['status'=>'1']);
                $kirim_pesan_id = $kirim->getInsertID();
                $permohonan = $conn->query("SELECT permohonan.*, mustahik.kontak FROM permohonan LEFT JOIN mustahik on mustahik.id=permohonan.mustahik_id where permohonan.status='Diterima'")->getResult();
                $data_pesan = [];
                foreach ($permohonan as $key => $value) {
                    $value->jadwal = $conn->query("SELECT * FROM jadwal_bayar WHERE tanggal_jatuh_tempo = date(CURDATE()+2) AND permohonan_id=$value->id")->getRow();
                    if(!is_null($value->jadwal)){
                        $result = $pesan->kirim($value->kontak, $value->jadwal->tanggal_jatuh_tempo);
                        $item = [
                            "kirim_pesan_id"=>$kirim_pesan_id,
                            "jadwal_bayar_id"=>$value->jadwal->id,
                            "messageId"=>$result['messageId'],
                            "to"=>$result['to'],
                            "status"=>$result['status'],
                            "text"=>$result['text'],
                            "cost"=>$result['cost'],
                        ];
                        $data_pesan[] = $item;
                    }
                }
                if(count($data_pesan)>0) $psn->insertBatch($data_pesan);
            }
            if($conn->transStatus()){
                $conn->transCommit();
                $data = $conn->query("SELECT * FROM kirim_pesan WHERE DATE(tanggal) = date(CURDATE())")->getRow();
                return $this->respond($data);
            }
        } catch (\Throwable $th) {
            $conn->transRollback();
            return $this->fail($th->getMessage());
        }
    }
}
