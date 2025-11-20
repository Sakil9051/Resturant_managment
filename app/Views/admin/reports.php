<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics - RestoAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gray-50">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 gradient-bg text-white flex-shrink-0 shadow-2xl no-print">
            <div class="p-6">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-utensils mr-3"></i>
                    RestoAdmin
                </h1>
            </div>
            
            <nav class="mt-6">
                <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
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
                <a href="<?= base_url('admin/reports') ?>" class="flex items-center px-6 py-3 bg-white bg-opacity-20 border-l-4 border-white">
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
            <header class="bg-white shadow-sm z-10 no-print">
                <div class="flex items-center justify-between px-8 py-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Reports & Analytics</h2>
                        <p class="text-sm text-gray-500 mt-1">Comprehensive business insights and data export</p>
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

            <!-- Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-8">
                
                <!-- Filters & Export Section -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6 no-print">
                    <form method="GET" action="<?= base_url('admin/reports') ?>" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Date Range -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-calendar mr-1"></i> Start Date
                                </label>
                                <input type="date" name="start_date" value="<?= $start_date ?>" 
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-calendar mr-1"></i> End Date
                                </label>
                                <input type="date" name="end_date" value="<?= $end_date ?>" 
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Report Type -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-filter mr-1"></i> Report Type
                                </label>
                                <select name="report_type" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="sales" <?= $report_type == 'sales' ? 'selected' : '' ?>>Sales Report</option>
                                    <option value="inventory" <?= $report_type == 'inventory' ? 'selected' : '' ?>>Inventory Report</option>
                                    <option value="staff" <?= $report_type == 'staff' ? 'selected' : '' ?>>Staff Performance</option>
                                </select>
                            </div>

                            <!-- Search -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-search mr-1"></i> Search
                                </label>
                                <input type="text" name="search" value="<?= $search ?>" placeholder="Order ID, Customer..." 
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t">
                            <div class="flex space-x-2">
                                <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition-all flex items-center">
                                    <i class="fas fa-sync mr-2"></i> Apply Filters
                                </button>
                                <a href="<?= base_url('admin/reports') ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg transition-all flex items-center">
                                    <i class="fas fa-redo mr-2"></i> Reset
                                </a>
                            </div>

                            <div class="flex space-x-2">
                                <a href="<?= base_url('admin/reports/export?format=csv&start_date=' . $start_date . '&end_date=' . $end_date) ?>" 
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-all flex items-center">
                                    <i class="fas fa-file-csv mr-2"></i> Export CSV
                                </a>
                                <a href="<?= base_url('admin/reports/export?format=pdf&start_date=' . $start_date . '&end_date=' . $end_date) ?>" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all flex items-center">
                                    <i class="fas fa-file-pdf mr-2"></i> Export PDF
                                </a>
                                <button onclick="window.print()" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg transition-all flex items-center">
                                    <i class="fas fa-print mr-2"></i> Print
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-green-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Sales</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">$<?= number_format($total_sales, 2) ?></h3>
                            </div>
                            <div class="p-3 bg-green-100 rounded-full text-green-600">
                                <i class="fas fa-dollar-sign text-xl"></i>
                            </div>
                        </div>
                        <p class="text-sm text-green-600 mt-4 flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> Period: <?= $start_date ?> to <?= $end_date ?>
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-blue-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Orders</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= $total_orders ?></h3>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                                <i class="fas fa-shopping-bag text-xl"></i>
                            </div>
                        </div>
                        <p class="text-sm text-blue-600 mt-4 flex items-center">
                            <i class="fas fa-chart-line mr-1"></i> Avg: $<?= number_format($avg_order_value, 2) ?> per order
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-purple-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Reservations</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= $total_reservations ?></h3>
                            </div>
                            <div class="p-3 bg-purple-100 rounded-full text-purple-600">
                                <i class="fas fa-calendar-check text-xl"></i>
                            </div>
                        </div>
                        <p class="text-sm text-purple-600 mt-4 flex items-center">
                            <i class="fas fa-users mr-1"></i> Bookings in period
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-orange-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Low Stock Items</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= count($low_stock_items) ?></h3>
                            </div>
                            <div class="p-3 bg-orange-100 rounded-full text-orange-600">
                                <i class="fas fa-exclamation-triangle text-xl"></i>
                            </div>
                        </div>
                        <p class="text-sm text-orange-600 mt-4 flex items-center">
                            <i class="fas fa-boxes mr-1"></i> Needs restocking
                        </p>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Sales Chart -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Sales Trend</h3>
                            <span class="text-sm text-gray-500">Daily Revenue</span>
                        </div>
                        <div class="relative h-80 w-full">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>

                    <!-- Orders Chart -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Order Status Distribution</h3>
                            <span class="text-sm text-gray-500">Current Period</span>
                        </div>
                        <div class="relative h-80 w-full flex items-center justify-center">
                            <canvas id="orderStatusChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Detailed Orders Table -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800">Detailed Orders Report</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if (empty($orders)): ?>
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                            <i class="fas fa-inbox text-4xl mb-2 text-gray-300"></i>
                                            <p>No orders found for the selected period</p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($orders as $order): ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">#<?= $order['id'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= $order['customer_name'] ?? 'N/A' ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">$<?= number_format($order['total'], 2) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                <?= $order['status'] == 'Completed' ? 'bg-green-100 text-green-800' : 
                                                    ($order['status'] == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') ?>">
                                                <?= $order['status'] ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('Y-m-d H:i', strtotime($order['created_at'])) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Low Stock Alert -->
                <?php if (!empty($low_stock_items)): ?>
                <div class="bg-orange-50 border-l-4 border-orange-500 rounded-lg p-6 mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-2xl text-orange-500"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-orange-800 mb-2">Low Stock Alert</h3>
                            <p class="text-sm text-orange-700 mb-3">The following items need restocking:</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <?php foreach($low_stock_items as $item): ?>
                                    <div class="bg-white rounded-lg p-3 border border-orange-200">
                                        <p class="font-semibold text-gray-800"><?= $item['name'] ?></p>
                                        <p class="text-sm text-orange-600">Stock: <?= $item['quantity'] ?> <?= $item['unit'] ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </main>
        </div>
    </div>

    <script>
        // Sales Trend Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesGradient = salesCtx.createLinearGradient(0, 0, 0, 400);
        salesGradient.addColorStop(0, 'rgba(102, 126, 234, 0.3)');
        salesGradient.addColorStop(1, 'rgba(102, 126, 234, 0)');

        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode($sales_chart_labels) ?>,
                datasets: [{
                    label: 'Sales ($)',
                    data: <?= json_encode($sales_chart_data) ?>,
                    borderColor: 'rgb(102, 126, 234)',
                    backgroundColor: salesGradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: 'rgb(102, 126, 234)',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Sales: $' + context.parsed.y.toFixed(2);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [2, 4], color: '#f0f0f0' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // Order Status Pie Chart
        const statusCtx = document.getElementById('orderStatusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending', 'Cancelled'],
                datasets: [{
                    data: [65, 25, 10],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: { size: 12, family: "'Inter', sans-serif" }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12
                    }
                }
            }
        });
    </script>

</body>
</html>
