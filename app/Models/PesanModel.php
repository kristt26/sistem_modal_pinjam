<?php

namespace App\Models;

use CodeIgniter\Model;

class PesanModel extends Model
{
    protected $table            = 'pesan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kirim_pesan_id', 'jadwal_bayar_id', 'messageId', 'to', 'status', 'text', 'cost'];

    protected bool $allowEmptyInserts = false;
    
}
