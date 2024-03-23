<?php

namespace App\Models;

use CodeIgniter\Model;

class InfakModel extends Model
{
    protected $table            = 'infak';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nominal', 'jadwal_bayar_id'];

    protected bool $allowEmptyInserts = false;
    
}
