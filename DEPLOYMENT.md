# Deployment to Hostinger Shared Hosting

This guide explains how to deploy the Restaurant Management System to Hostinger shared hosting.

## 📋 Prerequisites

- Hostinger shared hosting account
- FTP/SFTP access credentials
- MySQL database created in Hostinger cPanel
- Domain name configured

## 🚀 Deployment Steps

### 1. Prepare Your Files

Before uploading, make sure to:

```bash
# Remove development files
rm -rf .git
rm -rf tests
rm -rf writable/logs/*
rm -rf writable/cache/*
```

### 2. Database Setup

1. **Create Database in cPanel:**
   - Log in to Hostinger cPanel
   - Go to MySQL Databases
   - Create a new database (e.g., `u123456_restaurant`)
   - Create a database user
   - Add user to database with ALL PRIVILEGES

2. **Import Database:**
   - Go to phpMyAdmin
   - Select your database
   - Import your local database SQL dump
   - Or run migrations manually

3. **Run Migrations:**
   Upload and run the migration files:
   - `app/Database/Migrations/2025-11-20-create-notifications-table.sql`

### 3. Configure Environment

Edit `.env` file with your Hostinger details:

```env
# ENVIRONMENT
CI_ENVIRONMENT = production

# APP
app.baseURL = 'https://yourdomain.com/'

# DATABASE
database.default.hostname = localhost
database.default.database = u123456_restaurant
database.default.username = u123456_user
database.default.password = your_password
database.default.DBDriver = MySQLi
database.default.port = 3306

# SECURITY
encryption.key = your-32-character-encryption-key
```

### 4. Upload Files via FTP

**Using FileZilla or similar FTP client:**

1. Connect to your Hostinger FTP:
   - Host: `ftp.yourdomain.com`
   - Username: Your FTP username
   - Password: Your FTP password
   - Port: 21

2. Upload all files to `public_html` directory:
   ```
   /public_html/
   ├── app/
   ├── public/
   ├── vendor/
   ├── writable/
   ├── .env
   └── ...
   ```

### 5. Configure .htaccess

**Root .htaccess** (`public_html/.htaccess`):
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

**Public .htaccess** (`public_html/public/.htaccess`):
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    
    # Redirect to HTTPS
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
    
    # Remove index.php
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>

# Disable directory browsing
Options -Indexes

# Protect sensitive files
<FilesMatch "^\.">
    Order allow,deny
    Deny from all
</FilesMatch>
```

### 6. Set File Permissions

Set correct permissions via FTP or SSH:

```bash
# Directories
chmod 755 app/
chmod 755 public/
chmod 777 writable/
chmod 777 writable/cache/
chmod 777 writable/logs/
chmod 777 writable/session/
chmod 777 writable/uploads/

# Files
chmod 644 .env
chmod 644 app/Config/*.php
```

### 7. WebSocket Server Setup

**Note:** Hostinger shared hosting doesn't support long-running processes like WebSocket servers.

**Options:**

1. **Disable WebSocket Features:**
   - Comment out WebSocket scripts in views
   - Use polling instead for notifications

2. **Use External WebSocket Service:**
   - Pusher (https://pusher.com)
   - Ably (https://ably.com)
   - Socket.io with separate VPS

3. **Upgrade to VPS:**
   - For full WebSocket support
   - Run `websocket-server.php` as a service

**To disable WebSocket on shared hosting:**

Remove from `app/Views/Admin/dashboard.php` and other views:
```php
<!-- Comment out or remove these lines -->
<!-- <script src="<?= base_url('js/notifications.js') ?>"></script> -->
<!-- <?php include(APPPATH . 'Views/Admin/includes/websocket_integration.php'); ?> -->
```

### 8. Verify Deployment

1. **Check Homepage:**
   - Visit `https://yourdomain.com`
   - Verify it loads correctly

2. **Test Admin Login:**
   - Go to `https://yourdomain.com/admin/dashboard`
   - Login with your credentials

3. **Check Database Connection:**
   - Verify data is loading from database
   - Test CRUD operations

4. **Test All Features:**
   - Menu management
   - Orders
   - Reservations
   - Reports

## 🔧 Troubleshooting

### "500 Internal Server Error"

1. Check `.htaccess` syntax
2. Verify file permissions
3. Check error logs in cPanel

### "Database Connection Failed"

1. Verify database credentials in `.env`
2. Check if database user has proper privileges
3. Ensure database host is `localhost`

### "Page Not Found" Errors

1. Verify `.htaccess` files are uploaded
2. Check if mod_rewrite is enabled
3. Ensure `index.php` is in public directory

### Images/CSS Not Loading

1. Check file paths in views
2. Verify `app.baseURL` in `.env`
3. Clear browser cache

## 📊 Performance Optimization

### Enable Caching

In `app/Config/Cache.php`:
```php
public $handler = 'file';
```

### Enable Compression

Add to `.htaccess`:
```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript
</IfModule>
```

### Optimize Database

```sql
-- Add indexes for frequently queried columns
ALTER TABLE orders ADD INDEX idx_status (status);
ALTER TABLE reservations ADD INDEX idx_date (date);
ALTER TABLE notifications ADD INDEX idx_read (is_read);
```

## 🔐 Security Checklist

- [ ] Set `CI_ENVIRONMENT = production` in `.env`
- [ ] Change default admin password
- [ ] Set strong `encryption.key`
- [ ] Enable HTTPS (SSL certificate)
- [ ] Restrict file permissions
- [ ] Disable error display in production
- [ ] Enable CSRF protection
- [ ] Regular database backups
- [ ] Keep CodeIgniter updated

## 📞 Support

For Hostinger-specific issues:
- Hostinger Knowledge Base: https://support.hostinger.com
- Live Chat Support (24/7)

For application issues:
- Check application logs in `writable/logs/`
- Review CodeIgniter documentation

## 🔄 Updates & Maintenance

### Deploying Updates

1. Test changes locally
2. Backup production database
3. Upload changed files via FTP
4. Clear cache: Delete files in `writable/cache/`
5. Test thoroughly

### Database Backups

Set up automatic backups in Hostinger cPanel:
- Go to Backup section
- Enable automatic backups
- Download backups regularly

---

**Deployment Date:** <?= date('Y-m-d') ?>

**Version:** 1.0.0
