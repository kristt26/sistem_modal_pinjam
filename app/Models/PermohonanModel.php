<?php

namespace App\Models;

use CodeIgniter\Model;

class PermohonanModel extends Model
{
    protected $table            = 'permohonan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'mustahik_id', 'tanggal_pengajuan', 'tahapan', 'nominal_id', 'keterangan', 'status', 'waktu'];

    protected bool $allowEmptyInserts = false;
    
}
