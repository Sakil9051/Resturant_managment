<!-- Include this in your admin layout header or individual pages -->
<script src="<?= base_url('js/notifications.js') ?>"></script>

<script>
// Subscribe to relevant channels based on the page
document.addEventListener('DOMContentLoaded', function() {
    // Dashboard - subscribe to all channels
    if (window.location.pathname.includes('/admin/dashboard')) {
        notificationManager.subscribe('orders');
        notificationManager.subscribe('reservations');
        notificationManager.subscribe('inventory');
    }
    
    // Orders page
    if (window.location.pathname.includes('/admin/orders')) {
        notificationManager.subscribe('orders');
        
        // Custom handler for new orders
        notificationManager.on('orders:new_order', function(data) {
            console.log('New order received:', data);
            // Refresh orders table or add new row dynamically
            location.reload(); // Simple approach
        });
        
        // Custom handler for order status changes
        notificationManager.on('orders:order_status_changed', function(data) {
            console.log('Order status changed:', data);
            // Update specific order row
            const orderRow = document.querySelector(`[data-order-id="${data.order_id}"]`);
            if (orderRow) {
                const statusCell = orderRow.querySelector('.order-status');
                if (statusCell) {
                    statusCell.textContent = data.status;
                    statusCell.className = `order-status px-3 py-1 rounded-full text-xs ${getStatusClass(data.status)}`;
                }
            }
        });
    }
    
    // KDS page
    if (window.location.pathname.includes('/admin/kds')) {
        notificationManager.subscribe('kds');
        notificationManager.subscribe('orders');
        
        notificationManager.on('kds:kds_update', function(data) {
            console.log('KDS update:', data);
            location.reload(); // Refresh KDS display
        });
    }
    
    // Reservations page
    if (window.location.pathname.includes('/admin/reservations')) {
        notificationManager.subscribe('reservations');
        
        notificationManager.on('reservations:new_reservation', function(data) {
            console.log('New reservation:', data);
            location.reload();
        });
    }
    
    // Inventory page
    if (window.location.pathname.includes('/admin/inventory')) {
        notificationManager.subscribe('inventory');
        
        notificationManager.on('inventory:low_stock', function(data) {
            console.log('Low stock alert:', data);
            // Show prominent alert
            alert(`⚠️ Low Stock Alert: ${data.item_name} (${data.quantity} remaining)`);
        });
    }
});

function getStatusClass(status) {
    const classes = {
        'Pending': 'bg-yellow-100 text-yellow-800',
        'Preparing': 'bg-blue-100 text-blue-800',
        'Ready': 'bg-green-100 text-green-800',
        'Completed': 'bg-gray-100 text-gray-800',
        'Cancelled': 'bg-red-100 text-red-800'
    };
    return classes[status] || 'bg-gray-100 text-gray-800';
}
</script>
