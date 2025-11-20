/**
 * Real-time Notification System
 * Handles WebSocket connections and displays notifications
 */

class NotificationManager {
    constructor() {
        this.ws = null;
        this.reconnectAttempts = 0;
        this.maxReconnectAttempts = 5;
        this.reconnectDelay = 3000;
        this.subscriptions = new Set();
        this.handlers = {};
        
        this.connect();
    }

    connect() {
        try {
            this.ws = new WebSocket('ws://localhost:8080');
            
            this.ws.onopen = () => {
                console.log('✅ Connected to notification server');
                this.reconnectAttempts = 0;
                this.showToast('Connected to real-time notifications', 'success');
                
                // Resubscribe to channels
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
        } else {
            console.error('Max reconnection attempts reached');
            this.showToast('Unable to connect to notification server', 'error');
        }
    }

    subscribe(channel) {
        if (this.ws && this.ws.readyState === WebSocket.OPEN) {
            this.ws.send(JSON.stringify({
                type: 'subscribe',
                channel: channel
            }));
            this.subscriptions.add(channel);
            console.log(`📡 Subscribed to channel: ${channel}`);
        }
    }

    unsubscribe(channel) {
        if (this.ws && this.ws.readyState === WebSocket.OPEN) {
            this.ws.send(JSON.stringify({
                type: 'unsubscribe',
                channel: channel
            }));
            this.subscriptions.delete(channel);
        }
    }

    on(event, handler) {
        if (!this.handlers[event]) {
            this.handlers[event] = [];
        }
        this.handlers[event].push(handler);
    }

    handleMessage(message) {
        console.log('📨 Received:', message);

        switch (message.type) {
            case 'connection':
                console.log(message.message);
                break;

            case 'subscribed':
                console.log(`✅ ${message.message}`);
                break;

            case 'notification':
                this.handleNotification(message);
                break;

            default:
                console.log('Unknown message type:', message.type);
        }
    }

    handleNotification(message) {
        const { channel, data } = message;
        
        // Trigger registered handlers
        const eventKey = `${channel}:${data.event}`;
        if (this.handlers[eventKey]) {
            this.handlers[eventKey].forEach(handler => handler(data));
        }

        // Default notification display
        this.displayNotification(channel, data);
    }

    displayNotification(channel, data) {
        let title = '';
        let body = '';
        let icon = '';
        let color = 'blue';

        switch (data.event) {
            case 'new_order':
                title = '🛒 New Order';
                body = `Order #${data.order_id} received`;
                icon = 'fa-shopping-cart';
                color = 'green';
                this.playSound('new-order');
                break;

            case 'order_status_changed':
                title = '📦 Order Updated';
                body = `Order #${data.order_id} is now ${data.status}`;
                icon = 'fa-sync';
                color = 'blue';
                break;

            case 'new_reservation':
                title = '📅 New Reservation';
                body = `Reservation #${data.reservation_id} created`;
                icon = 'fa-calendar-check';
                color = 'purple';
                this.playSound('new-reservation');
                break;

            case 'low_stock':
                title = '⚠️ Low Stock Alert';
                body = `${data.item_name} is running low (${data.quantity} left)`;
                icon = 'fa-exclamation-triangle';
                color = 'orange';
                break;

            case 'kds_update':
                title = '🔥 Kitchen Update';
                body = `Order #${data.order_id} - ${data.action}`;
                icon = 'fa-fire';
                color = 'red';
                break;
        }

        this.showToast(body, color, icon, title);
        
        // Browser notification if permitted
        if ('Notification' in window && Notification.permission === 'granted') {
            new Notification(title, {
                body: body,
                icon: '/favicon.ico'
            });
        }
    }

    showToast(message, type = 'info', icon = '', title = '') {
        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            warning: 'bg-orange-500',
            info: 'bg-blue-500',
            blue: 'bg-blue-500',
            green: 'bg-green-500',
            red: 'bg-red-500',
            purple: 'bg-purple-500',
            orange: 'bg-orange-500'
        };

        const toast = document.createElement('div');
        toast.className = `fixed top-20 right-4 ${colors[type] || colors.info} text-white px-6 py-4 rounded-lg shadow-2xl transform transition-all duration-300 translate-x-full z-50 max-w-sm`;
        toast.style.animation = 'slideIn 0.3s forwards';
        
        toast.innerHTML = `
            <div class="flex items-start space-x-3">
                ${icon ? `<i class="fas ${icon} text-xl mt-1"></i>` : ''}
                <div class="flex-1">
                    ${title ? `<p class="font-bold mb-1">${title}</p>` : ''}
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

    playSound(type) {
        // Optional: Add sound effects
        const audio = new Audio(`/sounds/${type}.mp3`);
        audio.volume = 0.3;
        audio.play().catch(e => console.log('Sound play failed:', e));
    }

    requestNotificationPermission() {
        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission();
        }
    }

    disconnect() {
        if (this.ws) {
            this.ws.close();
        }
    }
}

// Add CSS animations
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

// Initialize notification manager
const notificationManager = new NotificationManager();

// Request notification permission on page load
document.addEventListener('DOMContentLoaded', () => {
    notificationManager.requestNotificationPermission();
});
