<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff - RestoAdmin</title>
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
                <a href="<?= base_url('admin/staff') ?>" class="flex items-center px-6 py-3 bg-white bg-opacity-20 border-l-4 border-white">
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
                        <h2 class="text-2xl font-bold text-gray-800">Edit Staff Member</h2>
                        <p class="text-sm text-gray-500 mt-1">Update staff details and permissions</p>
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

            <main class="flex-1 overflow-y-auto bg-gray-50 p-8">
                <div class="bg-white rounded-xl shadow-sm p-8 max-w-2xl mx-auto">
                    <form action="<?= base_url('admin/staff/update/' . $user['id']) ?>" method="post">
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                            <input type="text" name="username" value="<?= esc($user['name']) ?>" class="border border-gray-300 rounded-lg w-full py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" required>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email" value="<?= esc($user['email']) ?>" class="border border-gray-300 rounded-lg w-full py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" required>
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Password <span class="text-gray-400 font-normal">(Leave blank to keep current)</span></label>
                            <input type="password" name="password" class="border border-gray-300 rounded-lg w-full py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>
                        <div class="mb-8">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                            <select name="role_id" class="border border-gray-300 rounded-lg w-full py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" required>
                                <?php foreach($roles as $role): ?>
                                    <option value="<?= $role['id'] ?>" <?= $user['role_id'] == $role['id'] ? 'selected' : '' ?>><?= $role['role_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <a href="<?= base_url('admin/staff') ?>" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2.5 px-6 rounded-lg transition-all">Cancel</a>
                            <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-md transition-all transform hover:-translate-y-0.5">Update Staff</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
