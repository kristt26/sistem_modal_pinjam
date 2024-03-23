<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwal_bayar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tanggal_jatuh_tempo', 'permohonan_id', 'tagihan', 'tanggal_bayar', 'bayar', 'bukti', 'status', 'notif', 'catatan'];

    protected bool $allowEmptyInserts = false;
    
}
