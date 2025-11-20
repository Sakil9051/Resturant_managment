<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - RestoAdmin</title>
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
                        <h2 class="text-2xl font-bold text-gray-800">Notifications</h2>
                        <p class="text-sm text-gray-500 mt-1">Manage all your notifications</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div id="notification-bell"></div>
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
                
                <?php if(session()->getFlashdata('msg')):?>
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
                        <p class="font-bold">Success</p>
                        <p><?= session()->getFlashdata('msg') ?></p>
                    </div>
                <?php endif;?>

                <?php if(session()->getFlashdata('error')):?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                        <p class="font-bold">Error</p>
                        <p><?= session()->getFlashdata('error') ?></p>
                    </div>
                <?php endif;?>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Notifications</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= count($notifications) ?></h3>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                                <i class="fas fa-bell text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Unread</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= $unread_count ?></h3>
                            </div>
                            <div class="p-3 bg-red-100 rounded-full text-red-600">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Read</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= count($notifications) - $unread_count ?></h3>
                            </div>
                            <div class="p-3 bg-green-100 rounded-full text-green-600">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">All Notifications</h3>
                    <button onclick="markAllAsRead()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-all flex items-center">
                        <i class="fas fa-check-double mr-2"></i> Mark All as Read
                    </button>
                </div>

                <!-- Notifications List -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <?php if (empty($notifications)): ?>
                        <div class="p-12 text-center text-gray-500">
                            <i class="fas fa-bell-slash text-6xl mb-4 text-gray-300"></i>
                            <p class="text-lg">No notifications yet</p>
                            <p class="text-sm mt-2">You'll see notifications here when events occur</p>
                        </div>
                    <?php else: ?>
                        <div class="divide-y divide-gray-200">
                            <?php foreach($notifications as $notification): ?>
                                <div class="p-6 hover:bg-gray-50 transition-colors <?= $notification['is_read'] ? '' : 'bg-blue-50' ?>">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start space-x-4 flex-1">
                                            <div class="flex-shrink-0">
                                                <?php
                                                $icons = [
                                                    'new_order' => 'fa-shopping-cart text-green-500',
                                                    'order_status_changed' => 'fa-sync text-blue-500',
                                                    'new_reservation' => 'fa-calendar-check text-purple-500',
                                                    'low_stock' => 'fa-exclamation-triangle text-orange-500',
                                                    'kds_update' => 'fa-fire text-red-500'
                                                ];
                                                $icon = $icons[$notification['type']] ?? 'fa-bell text-gray-500';
                                                ?>
                                                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center">
                                                    <i class="fas <?= $icon ?> text-xl"></i>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center space-x-2">
                                                    <h4 class="text-base font-semibold text-gray-900"><?= $notification['title'] ?></h4>
                                                    <?php if (!$notification['is_read']): ?>
                                                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                                    <?php endif; ?>
                                                </div>
                                                <p class="text-sm text-gray-600 mt-1"><?= $notification['message'] ?></p>
                                                <p class="text-xs text-gray-400 mt-2">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    <?= date('M d, Y h:i A', strtotime($notification['created_at'])) ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2 ml-4">
                                            <?php if (!$notification['is_read']): ?>
                                                <button onclick="markAsRead(<?= $notification['id'] ?>)" class="text-blue-600 hover:text-blue-800 px-3 py-1 rounded hover:bg-blue-50 transition-all" title="Mark as read">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            <?php endif; ?>
                                            <button onclick="deleteNotification(<?= $notification['id'] ?>)" class="text-red-600 hover:text-red-800 px-3 py-1 rounded hover:bg-red-50 transition-all" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

            </main>
        </div>
    </div>

    <!-- WebSocket Real-time Notifications -->
    <script src="<?= base_url('js/notifications.js') ?>"></script>

    <script>
        async function markAsRead(id) {
            try {
                const response = await fetch(`<?= base_url('admin/notifications/mark-read/') ?>${id}`, {
                    method: 'POST'
                });
                
                if (response.ok) {
                    location.reload();
                }
            } catch (error) {
                console.error('Failed to mark as read:', error);
            }
        }

        async function markAllAsRead() {
            try {
                const response = await fetch(`<?= base_url('admin/notifications/mark-all-read') ?>`, {
                    method: 'POST'
                });
                
                if (response.ok) {
                    location.reload();
                }
            } catch (error) {
                console.error('Failed to mark all as read:', error);
            }
        }

        function deleteNotification(id) {
            if (confirm('Are you sure you want to delete this notification?')) {
                window.location.href = `<?= base_url('admin/notifications/delete/') ?>${id}`;
            }
        }
    </script>

</body>
</html>
