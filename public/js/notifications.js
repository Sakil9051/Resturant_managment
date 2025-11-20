/**
 * Simple Notification Manager (No WebSocket)
 * Loads notifications on page load and stores in localStorage
 */

class NotificationManager {
    constructor() {
        this.notifications = [];
        this.unreadCount = 0;

        this.initUI();
        this.loadNotifications();
    }

    initUI() {
        // Create notification bell UI if it doesn't exist
        const bellContainer = document.getElementById('notification-bell');
        if (bellContainer && !bellContainer.querySelector('.notification-dropdown')) {
            this.createBellUI(bellContainer);
        }
    }

    createBellUI(container) {
        container.innerHTML = `
            <div class="relative">
                <button id="notification-bell-btn" class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none">
                    <i class="fas fa-bell text-xl"></i>
                    <span id="notification-badge" class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center hidden">
                        0
                    </span>
                </button>
                
                <!-- Dropdown -->
                <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-2xl border border-gray-200 z-50" style="max-height: 500px;">
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Notifications</h3>
                        <button onclick="notificationManager.markAllRead()" class="text-sm text-blue-600 hover:text-blue-800">
                            Mark all read
                        </button>
                    </div>
                    
                    <div id="notification-list" class="overflow-y-auto" style="max-height: 350px;">
                        <div class="p-8 text-center text-gray-500">
                            <i class="fas fa-bell-slash text-4xl mb-2 text-gray-300"></i>
                            <p>No notifications yet</p>
                        </div>
                    </div>
                    
                    <div class="p-3 border-t border-gray-200 text-center">
                        <a href="${baseUrl}admin/notifications" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            View All Notifications
                        </a>
                    </div>
                </div>
            </div>
        `;

        // Add click handlers
        const bellBtn = document.getElementById('notification-bell-btn');
        const dropdown = document.getElementById('notification-dropdown');

        bellBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!container.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }

    async loadNotifications() {
        // Load from localStorage first for instant display
        const stored = localStorage.getItem('resto_notifications');
        if (stored) {
            this.notifications = JSON.parse(stored);
            this.updateUI();
        }

        // Fetch from server
        await this.fetchNotifications();
    }

    async fetchNotifications() {
        try {
            const response = await fetch(`${baseUrl}admin/notifications/recent`);
            const data = await response.json();

            if (data.success) {
                this.notifications = data.notifications || [];
                this.unreadCount = data.unread_count || 0;
                this.updateUI();
                this.saveToStorage();
            }
        } catch (error) {
            console.error('Failed to fetch notifications:', error);
        }
    }

    saveToStorage() {
        localStorage.setItem('resto_notifications', JSON.stringify(this.notifications));
    }

    updateUI() {
        // Update badge
        const badge = document.getElementById('notification-badge');
        if (badge) {
            if (this.unreadCount > 0) {
                badge.textContent = this.unreadCount > 99 ? '99+' : this.unreadCount;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        // Update dropdown list
        const list = document.getElementById('notification-list');
        if (list) {
            if (this.notifications.length === 0) {
                list.innerHTML = `
                    <div class="p-8 text-center text-gray-500">
                        <i class="fas fa-bell-slash text-4xl mb-2 text-gray-300"></i>
                        <p>No notifications yet</p>
                    </div>
                `;
            } else {
                list.innerHTML = this.notifications.slice(0, 10).map(n => this.renderNotification(n)).join('');
            }
        }
    }

    renderNotification(notification) {
        const icons = {
            'new_order': 'fa-shopping-cart text-green-500',
            'order_status_changed': 'fa-sync text-blue-500',
            'new_reservation': 'fa-calendar-check text-purple-500',
            'low_stock': 'fa-exclamation-triangle text-orange-500',
            'kds_update': 'fa-fire text-red-500'
        };

        const icon = icons[notification.type] || 'fa-bell text-gray-500';
        const bgClass = notification.is_read == 1 ? 'bg-white' : 'bg-blue-50';

        return `
            <div class="${bgClass} p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors cursor-pointer"
                 onclick="notificationManager.markRead(${notification.id})">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <i class="fas ${icon} text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900">${notification.title}</p>
                        <p class="text-sm text-gray-600 mt-1">${notification.message}</p>
                        <p class="text-xs text-gray-400 mt-1">${this.formatTime(notification.created_at)}</p>
                    </div>
                    ${notification.is_read == 0 ? '<div class="w-2 h-2 bg-blue-500 rounded-full"></div>' : ''}
                </div>
            </div>
        `;
    }

    formatTime(timestamp) {
        const date = new Date(timestamp);
        const now = new Date();
        const diff = now - date;
        const minutes = Math.floor(diff / 60000);
        const hours = Math.floor(diff / 3600000);
        const days = Math.floor(diff / 86400000);

        if (minutes < 1) return 'Just now';
        if (minutes < 60) return `${minutes}m ago`;
        if (hours < 24) return `${hours}h ago`;
        if (days < 7) return `${days}d ago`;
        return date.toLocaleDateString();
    }

    async markRead(id) {
        const notification = this.notifications.find(n => n.id == id);
        if (notification && notification.is_read == 0) {
            notification.is_read = 1;
            this.unreadCount = Math.max(0, this.unreadCount - 1);
            this.updateUI();
            this.saveToStorage();

            // Update on server
            try {
                await fetch(`${baseUrl}admin/notifications/mark-read/${id}`, {
                    method: 'POST'
                });
            } catch (error) {
                console.error('Failed to mark as read:', error);
            }
        }
    }

    async markAllRead() {
        this.notifications.forEach(n => n.is_read = 1);
        this.unreadCount = 0;
        this.updateUI();
        this.saveToStorage();

        try {
            await fetch(`${baseUrl}admin/notifications/mark-all-read`, {
                method: 'POST'
            });
        } catch (error) {
            console.error('Failed to mark all as read:', error);
        }
    }

    // Refresh notifications (call this periodically if needed)
    async refresh() {
        await this.fetchNotifications();
    }
}

// CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); }
        to { transform: translateX(0); }
    }
    @keyframes slideOut {
        from { transform: translateX(0); }
        to { transform: translateX(100%); }
    }
`;
document.head.appendChild(style);

// Initialize
const baseUrl = window.location.origin + '/resturant_managment/public/';
const notificationManager = new NotificationManager();

// Optional: Refresh notifications every 30 seconds
setInterval(() => {
    notificationManager.refresh();
}, 30000);
