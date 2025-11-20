<?php

namespace App\Models;

use CodeIgniter\Model;

class BuffetBookingModel extends Model
{
    protected $table            = 'buffet_bookings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'phone', 'adults', 'children', 'date', 'time_slot', 'status', 'notes'];

    protected bool $allowEmptyInserts = false;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
}
