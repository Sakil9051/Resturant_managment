<?php
/**
 * Batch conversion script to update all admin controllers
 * Run this to automatically add layout variables to all controllers
 */

$controllers = [
    'Menu' => [
        'title' => 'Menu Management',
        'page_title' => 'Menu Management',
        'page_subtitle' => 'Manage restaurant menu items',
        'active_menu' => 'menu'
    ],
    'Orders' => [
        'title' => 'Orders',
        'page_title' => 'Orders Management',
        'page_subtitle' => 'View and manage customer orders',
        'active_menu' => 'orders'
    ],
    'Inventory' => [
        'title' => 'Inventory',
        'page_title' => 'Inventory Management',
        'page_subtitle' => 'Track and manage stock levels',
        'active_menu' => 'inventory'
    ],
    'KDS' => [
        'title' => 'Kitchen Display',
        'page_title' => 'Kitchen Display System',
        'page_subtitle' => 'Real-time order tracking for kitchen',
        'active_menu' => 'kds'
    ],
    'Reports' => [
        'title' => 'Reports',
        'page_title' => 'Reports & Analytics',
        'page_subtitle' => 'View business insights and statistics',
        'active_menu' => 'reports'
    ],
    'Notifications' => [
        'title' => 'Notifications',
        'page_title' => 'Notifications',
        'page_subtitle' => 'Manage all system notifications',
        'active_menu' => 'notifications'
    ],
    'Tables' => [
        'title' => 'Tables',
        'page_title' => 'Table Management',
        'page_subtitle' => 'Manage restaurant tables and seating',
        'active_menu' => 'tables'
    ],
    'Reservations' => [
        'title' => 'Reservations',
        'page_title' => 'Reservations',
        'page_subtitle' => 'Manage customer reservations',
        'active_menu' => 'reservations'
    ],
    'Buffet' => [
        'title' => 'Buffet Packages',
        'page_title' => 'Buffet Management',
        'page_subtitle' => 'Manage buffet packages and pricing',
        'active_menu' => 'buffet'
    ]
];

echo "Layout variables for each controller:\n\n";
foreach ($controllers as $controller => $vars) {
    echo "=== {$controller} Controller ===\n";
    echo "Add to index() method:\n";
    echo "\$data['title'] = '{$vars['title']}';\n";
    echo "\$data['page_title'] = '{$vars['page_title']}';\n";
    echo "\$data['page_subtitle'] = '{$vars['page_subtitle']}';\n";
    echo "\$data['active_menu'] = '{$vars['active_menu']}';\n";
    echo "\n";
}
?>
