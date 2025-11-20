<?php

namespace App\Models;

use CodeIgniter\Model;

class BuffetPackageModel extends Model
{
    protected $table            = 'buffet_packages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'adult_price', 'child_price', 'items_list', 'time_slot'];

    protected bool $allowEmptyInserts = false;
    protected $useTimestamps = false;
}
