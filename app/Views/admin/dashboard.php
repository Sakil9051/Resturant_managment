<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Restaurant Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
    </style>
</head>
<body class="bg-gray-50">
    
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 gradient-bg text-white flex-shrink-0 shadow-2xl">
            <div class="p-6">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-utensils mr-3"></i>
                    RestoAdmin
                </h1>
            </div>
            
            <nav class="mt-6">
                <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center px-6 py-3 bg-white bg-opacity-20 border-l-4 border-white">
                    <i class="fas fa-home w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="<?= base_url('admin/tables') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-table w-5"></i>
                    <span class="ml-3">Tables</span>
                </a>
                <a href="<?= base_url('admin/reservations') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-calendar-check w-5"></i>
                    <span class="ml-3">Reservations</span>
                </a>
                <a href="<?= base_url('admin/menu') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-book-open w-5"></i>
                    <span class="ml-3">Menu</span>
                </a>
                <a href="<?= base_url('admin/buffet') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-birthday-cake w-5"></i>
                    <span class="ml-3">Buffet</span>
                </a>
                <a href="<?= base_url('admin/orders') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-shopping-cart w-5"></i>
                    <span class="ml-3">Orders</span>
                </a>
                <a href="<?= base_url('admin/kds') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-fire w-5"></i>
                    <span class="ml-3">KDS</span>
                </a>
                <a href="<?= base_url('admin/inventory') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-boxes w-5"></i>
                    <span class="ml-3">Inventory</span>
                </a>
                <a href="<?= base_url('admin/staff') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Staff</span>
                </a>
                <a href="<?= base_url('admin/reports') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span class="ml-3">Reports</span>
                </a>
                <div class="border-t border-white border-opacity-20 mt-6 pt-6">
                    <a href="<?= base_url('logout') ?>" class="flex items-center px-6 py-3 hover:bg-red-500 hover:bg-opacity-20 transition-all duration-200">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="ml-3">Logout</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-8 py-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                        <p class="text-sm text-gray-500 mt-1">Welcome back, Admin! Here's what's happening today.</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div class="flex items-center space-x-3 border-l pl-4">
                            <div class="w-10 h-10 rounded-full gradient-bg flex items-center justify-center text-white font-semibold">
                                A
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Admin User</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Orders -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm font-medium">Total Orders</p>
                                <h3 class="text-3xl font-bold mt-2">1,234</h3>
                                <p class="text-blue-100 text-xs mt-2">
                                    <i class="fas fa-arrow-up"></i> 12% from last month
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-3xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue -->
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-100 text-sm font-medium">Revenue</p>
                                <h3 class="text-3xl font-bold mt-2">$12,345</h3>
                                <p class="text-green-100 text-xs mt-2">
                                    <i class="fas fa-arrow-up"></i> 8% from last month
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-3xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Reservations -->
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-100 text-sm font-medium">Reservations</p>
                                <h3 class="text-3xl font-bold mt-2">45</h3>
                                <p class="text-purple-100 text-xs mt-2">
                                    <i class="fas fa-arrow-up"></i> 5% from last month
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <i class="fas fa-calendar-check text-3xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Orders -->
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-orange-100 text-sm font-medium">Pending Orders</p>
                                <h3 class="text-3xl font-bold mt-2">5</h3>
                                <p class="text-orange-100 text-xs mt-2">
                                    <i class="fas fa-clock"></i> Needs attention
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <i class="fas fa-hourglass-half text-3xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders & Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Orders -->
                    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">Recent Orders</h3>
                            <a href="<?= base_url('admin/orders') ?>" class="text-sm text-purple-600 hover:text-purple-700 font-medium">View All</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Table</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1001</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Table 1</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">$45.00</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Served
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1002</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Table 5</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">$78.50</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i> Preparing
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1003</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Table 3</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">$62.00</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                <i class="fas fa-utensils mr-1"></i> Ready
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="<?= base_url('admin/orders') ?>" class="flex items-center p-3 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg hover:from-blue-100 hover:to-blue-200 transition-all group">
                                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <span class="ml-3 font-medium text-gray-700">New Order</span>
                            </a>
                            <a href="<?= base_url('admin/reservations') ?>" class="flex items-center p-3 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg hover:from-purple-100 hover:to-purple-200 transition-all group">
                                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <span class="ml-3 font-medium text-gray-700">Reservations</span>
                            </a>
                            <a href="<?= base_url('admin/menu') ?>" class="flex items-center p-3 bg-gradient-to-r from-green-50 to-green-100 rounded-lg hover:from-green-100 hover:to-green-200 transition-all group">
                                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <span class="ml-3 font-medium text-gray-700">Manage Menu</span>
                            </a>
                            <a href="<?= base_url('admin/inventory') ?>" class="flex items-center p-3 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg hover:from-orange-100 hover:to-orange-200 transition-all group">
                                <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <i class="fas fa-boxes"></i>
                                </div>
                                <span class="ml-3 font-medium text-gray-700">Inventory</span>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>
