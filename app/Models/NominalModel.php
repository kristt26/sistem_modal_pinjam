<?php

namespace App\Models;

use CodeIgniter\Model;

class NominalModel extends Model
{
    protected $table            = 'nominal';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nominal'];

    protected bool $allowEmptyInserts = false;
    
}
