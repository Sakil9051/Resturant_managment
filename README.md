# 🍽️ Restaurant Management System

A comprehensive web-based restaurant management system built with CodeIgniter 4, featuring real-time order tracking, inventory management, reservation system, and advanced analytics.

![PHP](https://img.shields.io/badge/PHP-8.1+-blue)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-red)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange)
![License](https://img.shields.io/badge/license-MIT-green)

## 📋 Table of Contents

- [Features](#features)
- [Screenshots](#screenshots)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [API Documentation](#api-documentation)
- [Testing](#testing)
- [Deployment](#deployment)
- [Contributing](#contributing)
- [License](#license)

## ✨ Features

### Admin Dashboard
- **Real-time Analytics** - Live sales, orders, and reservation metrics
- **Interactive Floor Map** - Drag-and-drop table management with localStorage persistence
- **Advanced Reports** - Date-filtered reports with CSV/PDF export
- **Kitchen Display System (KDS)** - Real-time order tracking for kitchen staff

### Core Modules
- 📊 **Dashboard** - Comprehensive business overview with charts and KPIs
- 🍽️ **Menu Management** - CRUD operations for menu items with categories
- 🎂 **Buffet Packages** - Manage buffet offerings and pricing
- 📅 **Reservations** - Table booking system with status tracking
- 🛒 **Order Management** - Complete order lifecycle management
- 📦 **Inventory** - Stock tracking with low-stock alerts
- 👥 **Staff Management** - Employee records and role management
- 🪑 **Table Management** - Visual floor plan with real-time status
- 📈 **Reports & Analytics** - Advanced filtering, search, and export capabilities

### Key Highlights
- ✅ Responsive design with Tailwind CSS
- ✅ Real-time data visualization with Chart.js
- ✅ Custom delete confirmation modals
- ✅ Flash message feedback system
- ✅ Date range filtering and search
- ✅ Export to CSV, PDF, and Print
- ✅ Interactive drag-and-drop interfaces
- ✅ Low stock inventory alerts

## 📸 Screenshots

### Admin Dashboard
![Dashboard](docs/screenshots/dashboard.png)

### Live Floor Map
![Floor Map](docs/screenshots/floor-map.png)

### Reports & Analytics
![Reports](docs/screenshots/reports.png)

## 🛠️ Tech Stack

**Backend:**
- PHP 8.1+
- CodeIgniter 4.x
- MySQL 8.0+

**Frontend:**
- HTML5 / CSS3
- JavaScript (ES6+)
- Tailwind CSS
- Chart.js
- Font Awesome

**Development Tools:**
- Composer
- Git
- XAMPP / LAMP / WAMP

## 📦 Installation

### Prerequisites
- PHP >= 8.1
- MySQL >= 8.0
- Composer
- Web server (Apache/Nginx)

### Step-by-Step Setup

1. **Clone the repository**
```bash
git clone git@github.com:Sakil9051/Resturant_managment.git
cd Resturant_managment
```

2. **Install dependencies**
```bash
composer install
```

3. **Environment configuration**
```bash
cp env .env
```

4. **Configure database**
Edit `.env` file:
```env
database.default.hostname = localhost
database.default.database = restaurant_db
database.default.username = your_username
database.default.password = your_password
database.default.DBDriver = MySQLi
```

5. **Run migrations**
```bash
php spark migrate
```

6. **Seed database (optional)**
```bash
php spark db:seed DatabaseSeeder
```

7. **Start development server**
```bash
php spark serve
```

8. **Access the application**
```
http://localhost:8080
```

### Default Credentials
- **Admin:** admin@restaurant.com / admin123
- **Staff:** staff@restaurant.com / staff123

## ⚙️ Configuration

### Base URL
Update `app/Config/App.php`:
```php
public string $baseURL = 'http://localhost:8080/';
```

### Database
Configure in `.env` or `app/Config/Database.php`

### Email Settings
For reservation confirmations, configure SMTP in `.env`:
```env
email.protocol = smtp
email.SMTPHost = smtp.gmail.com
email.SMTPUser = your-email@gmail.com
email.SMTPPass = your-app-password
email.SMTPPort = 587
```

## 🚀 Usage

### Admin Panel
Access: `http://localhost:8080/admin/dashboard`

**Key Features:**
- View real-time statistics
- Manage menu items and categories
- Process orders and reservations
- Track inventory levels
- Generate reports with custom date ranges
- Export data to CSV/PDF

### Kitchen Display System (KDS)
Access: `http://localhost:8080/admin/kds`

**Features:**
- Real-time order updates
- Order status management (Pending → Preparing → Ready)
- Visual order cards with item details

### Reports
Access: `http://localhost:8080/admin/reports`

**Capabilities:**
- Date range filtering
- Search by order ID or customer
- Export to CSV, PDF, or Print
- Multiple report types (Sales, Inventory, Staff)
- Interactive charts and visualizations

## 📚 API Documentation

### Orders API
```php
// Get all orders
GET /api/orders

// Get order by ID
GET /api/orders/{id}

// Create order
POST /api/orders
Body: {
  "table_id": 1,
  "type": "Dine-in",
  "items": [...],
  "total": 150.00
}

// Update order status
PUT /api/orders/{id}/status
Body: { "status": "Completed" }
```

### Reservations API
```php
// Create reservation
POST /api/reservations
Body: {
  "name": "John Doe",
  "email": "john@example.com",
  "phone": "1234567890",
  "guests": 4,
  "date": "2025-11-25",
  "time": "19:00"
}
```

## 🧪 Testing

### Run PHPUnit Tests
```bash
composer test
```

### Run specific test suite
```bash
./vendor/bin/phpunit tests/unit/
```

### Code Coverage
```bash
composer test:coverage
```

## 🚢 Deployment

### Production Checklist
- [ ] Set `CI_ENVIRONMENT = production` in `.env`
- [ ] Enable CSRF protection
- [ ] Configure secure database credentials
- [ ] Set up SSL certificate
- [ ] Configure backup strategy
- [ ] Enable error logging
- [ ] Optimize autoloader
- [ ] Set proper file permissions

### Apache Configuration
```apache
<VirtualHost *:80>
    ServerName restaurant.example.com
    DocumentRoot /var/www/restaurant/public
    
    <Directory /var/www/restaurant/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### Nginx Configuration
```nginx
server {
    listen 80;
    server_name restaurant.example.com;
    root /var/www/restaurant/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
}
```

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Coding Standards
- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add tests for new features
- Update documentation as needed

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Authors

- **Sakil** - *Initial work* - [Sakil9051](https://github.com/Sakil9051)

## 🙏 Acknowledgments

- CodeIgniter Framework
- Tailwind CSS
- Chart.js
- Font Awesome
- All contributors and testers

## 📞 Support

For support, email sakil@example.com or open an issue on GitHub.

## 🗺️ Roadmap

- [ ] Mobile app (React Native)
- [ ] Online ordering system
- [ ] Payment gateway integration
- [ ] Multi-language support
- [ ] Customer loyalty program
- [ ] Advanced analytics with AI insights
- [ ] Real-time notifications (WebSockets)

---

**Made with ❤️ by Sakil**
