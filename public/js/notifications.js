/**
 * Enhanced Notification Manager with UI Components
 * Includes bell icon, badge counter, dropdown, and persistent storage
 */

class NotificationManager {
    constructor() {
        this.ws = null;
        this.reconnectAttempts = 0;
        this.maxReconnectAttempts = 5;
        this.reconnectDelay = 3000;
        this.subscriptions = new Set();
        this.handlers = {};
        this.notifications = [];
        this.unreadCount = 0;

        this.initUI();
        this.loadNotifications();
        this.connect();
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

    loadNotifications() {
        // Load from localStorage
        const stored = localStorage.getItem('resto_notifications');
        if (stored) {
            this.notifications = JSON.parse(stored);
            this.updateUI();
        }

        // Fetch from server
        this.fetchNotifications();
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

    addNotification(notification) {
        // Add to beginning of array
        this.notifications.unshift({
            id: Date.now(),
            ...notification,
            is_read: false,
            created_at: new Date().toISOString()
        });

        // Keep only last 50 notifications in memory
        if (this.notifications.length > 50) {
            this.notifications = this.notifications.slice(0, 50);
        }

        this.unreadCount++;
        this.updateUI();
        this.saveToStorage();

        // Save to server
        this.saveToServer(notification);
    }

    async saveToServer(notification) {
        try {
            await fetch(`${baseUrl}admin/notifications/create`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(notification)
            });
        } catch (error) {
            console.error('Failed to save notification:', error);
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
        const bgClass = notification.is_read ? 'bg-white' : 'bg-blue-50';

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
                    ${!notification.is_read ? '<div class="w-2 h-2 bg-blue-500 rounded-full"></div>' : ''}
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
        const notification = this.notifications.find(n => n.id === id);
        if (notification && !notification.is_read) {
            notification.is_read = true;
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
        this.notifications.forEach(n => n.is_read = true);
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

    // WebSocket methods (keeping existing functionality)
    connect() {
        try {
            this.ws = new WebSocket('ws://localhost:8080');

            this.ws.onopen = () => {
                console.log('✅ Connected to notification server');
                this.reconnectAttempts = 0;

                this.subscriptions.forEach(channel => {
                    this.subscribe(channel);
                });
            };

            this.ws.onmessage = (event) => {
                this.handleMessage(JSON.parse(event.data));
            };

            this.ws.onerror = (error) => {
                console.error('WebSocket error:', error);
            };

            this.ws.onclose = () => {
                console.log('❌ Disconnected from notification server');
                this.attemptReconnect();
            };
        } catch (error) {
            console.error('Failed to create WebSocket connection:', error);
            this.attemptReconnect();
        }
    }

    attemptReconnect() {
        if (this.reconnectAttempts < this.maxReconnectAttempts) {
            this.reconnectAttempts++;
            console.log(`Reconnecting... (Attempt ${this.reconnectAttempts}/${this.maxReconnectAttempts})`);

            setTimeout(() => {
                this.connect();
            }, this.reconnectDelay);
        }
    }

    subscribe(channel) {
        if (this.ws && this.ws.readyState === WebSocket.OPEN) {
            this.ws.send(JSON.stringify({
                type: 'subscribe',
                channel: channel
            }));
            this.subscriptions.add(channel);
        }
    }

    on(event, handler) {
        if (!this.handlers[event]) {
            this.handlers[event] = [];
        }
        this.handlers[event].push(handler);
    }

    handleMessage(message) {
        if (message.type === 'notification') {
            this.handleNotification(message);
        }
    }

    handleNotification(message) {
        const { channel, data } = message;

        // Add to notifications list
        this.addNotification({
            type: data.event,
            title: this.getNotificationTitle(data.event),
            message: this.getNotificationMessage(data),
            data: JSON.stringify(data)
        });

        // Trigger registered handlers
        const eventKey = `${channel}:${data.event}`;
        if (this.handlers[eventKey]) {
            this.handlers[eventKey].forEach(handler => handler(data));
        }

        // Show toast
        this.showToast(this.getNotificationMessage(data), 'info');
    }

    getNotificationTitle(event) {
        const titles = {
            'new_order': '🛒 New Order',
            'order_status_changed': '📦 Order Updated',
            'new_reservation': '📅 New Reservation',
            'low_stock': '⚠️ Low Stock Alert',
            'kds_update': '🔥 Kitchen Update'
        };
        return titles[event] || 'Notification';
    }

    getNotificationMessage(data) {
        switch (data.event) {
            case 'new_order':
                return `Order #${data.order_id} received`;
            case 'order_status_changed':
                return `Order #${data.order_id} is now ${data.status}`;
            case 'new_reservation':
                return `Reservation #${data.reservation_id} created`;
            case 'low_stock':
                return `${data.item_name} is running low (${data.quantity} left)`;
            case 'kds_update':
                return `Order #${data.order_id} - ${data.action}`;
            default:
                return 'New notification';
        }
    }

    showToast(message, type = 'info') {
        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            warning: 'bg-orange-500',
            info: 'bg-blue-500'
        };

        const toast = document.createElement('div');
        toast.className = `fixed top-20 right-4 ${colors[type]} text-white px-6 py-4 rounded-lg shadow-2xl transform transition-all duration-300 translate-x-full z-50 max-w-sm`;
        toast.style.animation = 'slideIn 0.3s forwards';

        toast.innerHTML = `
            <div class="flex items-start space-x-3">
                <div class="flex-1">
                    <p class="text-sm">${message}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s forwards';
            setTimeout(() => toast.remove(), 300);
        }, 5000);
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
