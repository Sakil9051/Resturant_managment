<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitialSchema extends Migration
{
    public function up()
    {
        // Roles
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'role_name' => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('roles');

        // Users
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users');

        // Tables
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'table_number' => ['type' => 'VARCHAR', 'constraint' => 20],
            'seats' => ['type' => 'INT', 'constraint' => 5],
            'status' => ['type' => 'ENUM', 'constraint' => ['Available', 'Occupied', 'Reserved'], 'default' => 'Available'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tables');

        // Reservations
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20],
            'guests' => ['type' => 'INT', 'constraint' => 5],
            'date' => ['type' => 'DATE'],
            'time' => ['type' => 'TIME'],
            'table_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['Pending', 'Confirmed', 'Rejected', 'Completed'], 'default' => 'Pending'],
            'notes' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('table_id', 'tables', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('reservations');

        // Buffet Packages
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'adult_price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'child_price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'items_list' => ['type' => 'JSON', 'null' => true],
            'time_slot' => ['type' => 'VARCHAR', 'constraint' => 50], // e.g., Lunch, Dinner
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('buffet_packages');

        // Buffet Bookings
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20],
            'adults' => ['type' => 'INT', 'constraint' => 5],
            'children' => ['type' => 'INT', 'constraint' => 5],
            'date' => ['type' => 'DATE'],
            'time_slot' => ['type' => 'VARCHAR', 'constraint' => 50],
            'status' => ['type' => 'ENUM', 'constraint' => ['Pending', 'Confirmed', 'Cancelled'], 'default' => 'Pending'],
            'notes' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('buffet_bookings');

        // Menu Categories
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('menu_categories');

        // Menu Items
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'available' => ['type' => 'BOOLEAN', 'default' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'menu_categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('menu_items');

        // Orders
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'table_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'type' => ['type' => 'ENUM', 'constraint' => ['Dine-in', 'Takeaway'], 'default' => 'Dine-in'],
            'total' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'status' => ['type' => 'ENUM', 'constraint' => ['Pending', 'Preparing', 'Ready', 'Served', 'Paid', 'Cancelled'], 'default' => 'Pending'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('table_id', 'tables', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('orders');

        // Order Items
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'order_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'menu_item_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'qty' => ['type' => 'INT', 'constraint' => 5],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('menu_item_id', 'menu_items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('order_items');

        // Ingredients
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'unit' => ['type' => 'VARCHAR', 'constraint' => 20], // kg, g, l, pcs
            'quantity' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'min_threshold' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 5.00],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ingredients');

        // Inventory Transactions
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ingredient_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'change_qty' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'type' => ['type' => 'ENUM', 'constraint' => ['Add', 'Deduct'], 'default' => 'Deduct'],
            'date' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('ingredient_id', 'ingredients', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory_transactions');

        // Staff
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'role_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['Active', 'Inactive'], 'default' => 'Active'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('staff');
    }

    public function down()
    {
        $this->forge->dropTable('staff');
        $this->forge->dropTable('inventory_transactions');
        $this->forge->dropTable('ingredients');
        $this->forge->dropTable('order_items');
        $this->forge->dropTable('orders');
        $this->forge->dropTable('menu_items');
        $this->forge->dropTable('menu_categories');
        $this->forge->dropTable('buffet_bookings');
        $this->forge->dropTable('buffet_packages');
        $this->forge->dropTable('reservations');
        $this->forge->dropTable('tables');
        $this->forge->dropTable('users');
        $this->forge->dropTable('roles');
    }
}
