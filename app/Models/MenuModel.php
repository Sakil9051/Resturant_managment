<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table            = 'menu_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['category_id', 'name', 'price', 'image', 'description', 'available'];

    protected bool $allowEmptyInserts = false;
    protected $useTimestamps = false;
    
    public function getItemsWithCategory()
    {
        return $this->select('menu_items.*, menu_categories.name as category_name')
                    ->join('menu_categories', 'menu_categories.id = menu_items.category_id')
                    ->findAll();
    }
}
