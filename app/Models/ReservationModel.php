<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table            = 'reservations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'phone', 'guests', 'date', 'time', 'table_id', 'status', 'notes'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // No updated_at column in schema for reservations, or maybe I missed it. Checking schema... 
    // Schema has created_at only. Wait, let me check migration.
    // Migration: 'created_at' => ['type' => 'DATETIME', 'null' => true],
    // No updated_at. So I will disable updatedField.
}
