<?php

namespace App\Models;

use CodeIgniter\Model;

class KelengkapanModel extends Model
{
    protected $table            = 'kelengkapan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kelengkapan'];

    protected bool $allowEmptyInserts = false;
    
}
