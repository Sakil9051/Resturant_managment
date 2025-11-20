<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30"> <!-- Auto refresh every 30s -->
    <title>Kitchen Display System - RestoAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
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
                <a href="<?= base_url('admin/kds') ?>" class="flex items-center px-6 py-3 bg-white bg-opacity-20 border-l-4 border-white">
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
                        <h2 class="text-2xl font-bold text-gray-800">Kitchen Display System</h2>
                        <p class="text-sm text-gray-500 mt-1">Real-time order tracking for kitchen staff</p>
                    </div>
                    <div class="flex items-center space-x-4">
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
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php if(empty($orders)): ?>
                        <div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-500">
                            <i class="fas fa-utensils text-6xl mb-4 text-gray-300"></i>
                            <h2 class="text-2xl font-bold">No Active Orders</h2>
                            <p>Waiting for new orders to arrive...</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($orders as $order): ?>
                        <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 transition-all hover:shadow-lg <?= $order['status'] == 'Pending' ? 'border-yellow-500' : 'border-blue-500' ?>">
                            <div class="p-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                                <h3 class="font-bold text-lg text-gray-800">Order #<?= $order['id'] ?></h3>
                                <span class="text-sm font-medium text-gray-500 flex items-center">
                                    <i class="far fa-clock mr-1"></i> <?= date('H:i', strtotime($order['created_at'])) ?>
                                </span>
                            </div>
                            <div class="p-4">
                                <div class="mb-4 flex justify-between items-start">
                                    <span class="inline-block px-2 py-1 rounded text-xs font-bold uppercase tracking-wide
                                        <?= $order['status'] == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' ?>">
                                        <?= $order['status'] ?>
                                    </span>
                                    <span class="text-gray-600 text-sm font-medium bg-gray-100 px-2 py-1 rounded">
                                        <?= $order['table_id'] ? 'Table ' . $order['table_id'] : 'Takeaway' ?>
                                    </span>
                                </div>
                                
                                <!-- Items List -->
                                <div class="mb-6">
                                    <p class="text-xs text-gray-400 uppercase font-bold mb-2">Items</p>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <?php if(isset($order['items']) && !empty($order['items'])): ?>
                                            <?php foreach($order['items'] as $item): ?>
                                            <li class="flex justify-between border-b border-dashed border-gray-200 pb-1">
                                                <span><?= $item['qty'] ?>x <?= esc($item['name']) ?></span>
                                            </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li class="text-gray-400 italic">No items found</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>

                                <div class="flex space-x-2">
                                    <?php if($order['status'] == 'Pending'): ?>
                                        <a href="<?= base_url('admin/kds/update/' . $order['id'] . '/Preparing') ?>" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-bold text-sm transition-colors shadow-sm text-center">
                                            Start Preparing
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= base_url('admin/kds/update/' . $order['id'] . '/Ready') ?>" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-bold text-sm transition-colors shadow-sm text-center">
                                            Mark Ready
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

</body>
</html>
