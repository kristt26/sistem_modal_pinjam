<?php

namespace App\Models;

use CodeIgniter\Model;

class MustahikModel extends Model
{
    protected $table            = 'mustahik';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nomor', 'nik', 'nama', 'alamat', 'kontak', 'kontak_lain', 'user_id'];

    protected bool $allowEmptyInserts = false;
    
}
