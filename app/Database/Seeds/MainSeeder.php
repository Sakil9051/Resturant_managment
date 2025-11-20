<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // Seed Roles
        $roles = [
            ['role_name' => 'Admin'],
            ['role_name' => 'Manager'],
            ['role_name' => 'Waiter'],
            ['role_name' => 'Chef'],
            ['role_name' => 'Cashier'],
        ];

        $this->db->table('roles')->insertBatch($roles);

        // Get Admin Role ID
        $roleModel = $this->db->table('roles');
        $adminRole = $roleModel->where('role_name', 'Admin')->get()->getRow();

        // Seed Admin User
        $data = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role_id' => $adminRole->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($data);
        
        // Seed some initial tables
        $tables = [];
        for ($i = 1; $i <= 10; $i++) {
            $tables[] = [
                'table_number' => 'T' . $i,
                'seats' => rand(2, 6),
                'status' => 'Available'
            ];
        }
        $this->db->table('tables')->insertBatch($tables);
        
        // Seed some menu categories
        $categories = [
            ['name' => 'Starters'],
            ['name' => 'Main Course'],
            ['name' => 'Desserts'],
            ['name' => 'Beverages']
        ];
        $this->db->table('menu_categories')->insertBatch($categories);
    }
}
