<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<!-- Flash Messages -->
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

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Orders -->
    <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-blue-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Orders</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
                <p class="text-sm text-green-600 mt-2">
                    <i class="fas fa-arrow-up"></i> 12% from last month
                </p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                <i class="fas fa-shopping-cart text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-green-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Revenue</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">$0</h3>
                <p class="text-sm text-green-600 mt-2">
                    <i class="fas fa-arrow-up"></i> 8% from last month
                </p>
            </div>
            <div class="p-3 bg-green-100 rounded-full text-green-600">
                <i class="fas fa-dollar-sign text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Reservations -->
    <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-purple-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Reservations</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
                <p class="text-sm text-green-600 mt-2">
                    <i class="fas fa-arrow-up"></i> 5% from last month
                </p>
            </div>
            <div class="p-3 bg-purple-100 rounded-full text-purple-600">
                <i class="fas fa-calendar-check text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Active Tables -->
    <div class="bg-white rounded-xl shadow-sm p-6 card-hover border-l-4 border-orange-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Active Tables</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
                <p class="text-sm text-gray-500 mt-2">
                    Currently occupied
                </p>
            </div>
            <div class="p-3 bg-orange-100 rounded-full text-orange-600">
                <i class="fas fa-table text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="<?= base_url('admin/orders') ?>" class="flex items-center p-3 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg hover:from-blue-100 hover:to-blue-200 transition-all group">
            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                <i class="fas fa-plus"></i>
            </div>
            <span class="ml-3 font-medium text-gray-700">New Order</span>
        </a>
        <a href="<?= base_url('admin/reservations') ?>" class="flex items-center p-3 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg hover:from-purple-100 hover:to-purple-200 transition-all group">
            <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                <i class="fas fa-calendar-plus"></i>
            </div>
            <span class="ml-3 font-medium text-gray-700">Reservation</span>
        </a>
        <a href="<?= base_url('admin/menu') ?>" class="flex items-center p-3 bg-gradient-to-r from-green-50 to-green-100 rounded-lg hover:from-green-100 hover:to-green-200 transition-all group">
            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                <i class="fas fa-utensils"></i>
            </div>
            <span class="ml-3 font-medium text-gray-700">Menu</span>
        </a>
        <a href="<?= base_url('admin/inventory') ?>" class="flex items-center p-3 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg hover:from-orange-100 hover:to-orange-200 transition-all group">
            <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                <i class="fas fa-boxes"></i>
            </div>
            <span class="ml-3 font-medium text-gray-700">Inventory</span>
        </a>
    </div>
</div>

<?= $this->endSection() ?>
