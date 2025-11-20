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

<!-- Page content -->
<div class="bg-white rounded-xl shadow-sm p-6">
    <p class="text-gray-600">Kitchen Display System - This view extends the shared layout with notification bell!</p>
    <p class="text-sm text-gray-500 mt-2">The notification bell in the header works across all pages now.</p>
</div>

<?= $this->endSection() ?>
