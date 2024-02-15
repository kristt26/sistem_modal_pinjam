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
    protected $allowedFields    = ['mustahik_id', 'tanggal_pengajuan', 'status'];

    protected bool $allowEmptyInserts = false;
    
}
