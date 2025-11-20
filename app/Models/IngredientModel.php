<?php

namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model
{
    protected $table            = 'ingredients';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'unit', 'quantity', 'min_threshold'];

    protected bool $allowEmptyInserts = false;
    protected $useTimestamps = false;
}
