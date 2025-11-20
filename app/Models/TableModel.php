<?php

namespace App\Models;

use CodeIgniter\Model;

class TableModel extends Model
{
    protected $table            = 'tables';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['table_number', 'seats', 'status'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
}
