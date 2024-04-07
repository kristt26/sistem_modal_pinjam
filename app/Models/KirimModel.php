<?php

namespace App\Models;

use CodeIgniter\Model;

class KirimModel extends Model
{
    protected $table            = 'kirim_pesan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tanggal', 'status'];

    protected bool $allowEmptyInserts = false;
    
}
