# DMDI Magazine - cPanel Deployment Guide

## Prerequisites

- cPanel hosting account with PHP 8.2+
- MySQL database access
- SSH access (recommended) or File Manager
- Domain configured and pointing to your hosting

## Step 1: Prepare Your Local Environment

### Build Production Assets

```bash
# On your local machine
cd dmdi-magazine

# Install dependencies if not already installed
composer install --no-dev --optimize-autoloader
npm install

# Build production assets
npm run build

# Create a clean archive for upload
zip -r dmdi-magazine.zip . -x "*.git*" "node_modules/*" "tests/*" ".env"
```

## Step 2: Upload Files to cPanel

### Option A: Using File Manager

1. Log in to cPanel
2. Navigate to **File Manager**
3. Go to `public_html` directory
4. Upload `dmdi-magazine.zip`
5. Extract the archive
6. Move all contents from `dmdi-magazine` folder to `public_html` root

### Option B: Using SSH (Recommended)

```bash
# Connect to your server
ssh username@yourdomain.com

# Navigate to web root
cd public_html

# Upload using scp or git
git clone <your-repository>
cd dmdi-magazine

# Or if uploading archive
unzip dmdi-magazine.zip
```

## Step 3: Configure cPanel PHP Settings

1. In cPanel, go to **Select PHP Version**
2. Select PHP 8.2 or higher
3. Enable the following extensions:
   - BCMath
   - Ctype
   - JSON
   - Mbstring
   - OpenSSL
   - PDO
   - PDO_MySQL
   - Tokenizer
   - XML
   - GD (for image processing)

## Step 4: Create MySQL Database

1. In cPanel, go to **MySQL Databases**
2. Create a new database: `yourdomain_dmdi`
3. Create a new user: `yourdomain_dmdi_user`
4. Set a strong password
5. Add user to database with ALL PRIVILEGES
6. Note down:
   - Database name
   - Database username
   - Database password
   - Database host (usually `localhost`)

## Step 5: Configure Environment

1. Copy `.env.example` to `.env`:
   ```bash
   cp .env.example .env
   ```

2. Edit `.env` file with your database credentials:
   ```env
   APP_NAME="DMDI Magazine"
   APP_ENV=production
   APP_KEY=
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   LOG_CHANNEL=stack
   LOG_LEVEL=error

   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=yourdomain_dmdi
   DB_USERNAME=yourdomain_dmdi_user
   DB_PASSWORD=your_secure_password

   BROADCAST_DRIVER=log
   CACHE_DRIVER=file
   FILESYSTEM_DISK=local
   QUEUE_CONNECTION=database
   SESSION_DRIVER=database
   SESSION_LIFETIME=120

   APP_LOCALE=id
   APP_FALLBACK_LOCALE=id
   ```

## Step 6: Run Artisan Commands

### Via SSH

```bash
# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Seed database
php artisan db:seed

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Via cPanel Terminal

If SSH is not available:
1. Go to **Terminal** in cPanel
2. Navigate to your application directory
3. Run the commands above

### Without SSH Access

If you don't have SSH/Terminal access, create a setup script:

Create `setup.php` in your web root:

```php
<?php
// setup.php - Run once then delete this file!

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Generate key
$kernel->call('key:generate', ['--force' => true]);

// Run migrations
$kernel->call('migrate', ['--force' => true]);

// Seed database
$kernel->call('db:seed', ['--force' => true]);

// Cache config
$kernel->call('config:cache');
$kernel->call('route:cache');
$kernel->call('view:cache');

echo "Setup completed successfully! DELETE THIS FILE NOW!";
```

Access `https://yourdomain.com/setup.php` once, then **DELETE** the file.

## Step 7: Configure Web Server

### Public Directory Setup

Laravel requires the `public` folder to be your document root.

#### Option A: Move public contents (Recommended)

```bash
# Backup original public_html
mv public_html public_html_backup

# Move Laravel public to public_html
mv dmdi-magazine/public public_html

# Update index.php paths
# Edit public_html/index.php
# Change: require __DIR__.'/../vendor/autoload.php';
# To: require __DIR__.'/../dmdi-magazine/vendor/autoload.php';

# Change: $app = require_once __DIR__.'/../bootstrap/app.php';
# To: $app = require_once __DIR__.'/../dmdi-magazine/bootstrap/app.php';
```

#### Option B: Using .htaccess redirect

If you can't change document root, create `.htaccess` in `public_html`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

## Step 8: Set File Permissions

```bash
# Set permissions for storage and cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Set ownership (adjust username)
chown -R username:username storage
chown -R username:username bootstrap/cache
```

## Step 9: Configure SSL Certificate

1. In cPanel, go to **SSL/TLS Status**
2. Enable AutoSSL or install Let's Encrypt certificate
3. Ensure your domain is using HTTPS
4. Update `.env` file:
   ```env
   APP_URL=https://yourdomain.com
   ```

## Step 10: Create Admin User

Via SSH/Terminal:
```bash
php artisan tinker
```

Then:
```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'your-email@domain.com',
    'password' => bcrypt('your-secure-password'),
    'is_admin' => true
]);
exit
```

## Step 11: Test Your Deployment

1. Access your website: `https://yourdomain.com/id`
2. Test language switching: `https://yourdomain.com/en`
3. Test article pages
4. Test category pages
5. Test admin login: `https://yourdomain.com/admin/login`

## Step 12: Post-Deployment Configuration

### Set Up Cron Jobs

1. In cPanel, go to **Cron Jobs**
2. Add a new cron job:
   ```
   * * * * * cd /home/username/public_html && php artisan schedule:run >> /dev/null 2>&1
   ```

### Configure Email (Optional)

Update `.env` with SMTP settings:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.yourdomain.com
MAIL_PORT=587
MAIL_USERNAME=your-email@yourdomain.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Set Up Backup

1. In cPanel, go to **Backup Wizard**
2. Schedule automatic daily backups
3. Or use cron job:
   ```bash
   0 2 * * * cd /home/username/public_html && php artisan backup:run
   ```

## Troubleshooting

### 500 Internal Server Error
- Check `.env` file exists and is configured
- Verify file permissions (775 for storage/bootstrap)
- Check error logs in `storage/logs/laravel.log`
- Clear cache: `php artisan cache:clear`

### Database Connection Error
- Verify database credentials in `.env`
- Check if database user has proper privileges
- Test connection from cPanel phpMyAdmin

### Page Not Found (404)
- Ensure `.htaccess` exists in public directory
- Verify mod_rewrite is enabled
- Check public folder is set as document root

### Assets Not Loading
- Verify files in `public/build` directory exist
- Check file permissions
- Clear browser cache
- Run `npm run build` again if needed

### White Screen / Blank Page
- Set `APP_DEBUG=true` temporarily to see errors
- Check PHP error logs in cPanel
- Verify PHP version is 8.2+

## Security Checklist

- [ ] `.env` file has proper permissions (600)
- [ ] `APP_DEBUG=false` in production
- [ ] Strong database password set
- [ ] SSL certificate installed and active
- [ ] Admin user has strong password
- [ ] Removed `setup.php` if created
- [ ] File upload directory secured
- [ ] Regular backups configured
- [ ] Logs directory not publicly accessible
- [ ] Keep Laravel and dependencies updated

## Maintenance

### Update Application

```bash
# Pull latest changes
git pull origin main

# Update dependencies
composer install --no-dev --optimize-autoloader
npm install && npm run build

# Run migrations
php artisan migrate --force

# Clear and rebuild cache
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Monitor Logs

Check `storage/logs/laravel.log` regularly for errors.

### Database Backup

```bash
# Manual backup
mysqldump -u username -p database_name > backup_$(date +%Y%m%d).sql
```

## Performance Optimization

1. **Enable OPcache** in PHP settings
2. **Use Redis** for caching (if available)
3. **Enable Gzip** compression
4. **Optimize images** before upload
5. **Use CDN** for static assets (optional)

## Support

For issues or questions:
- Check Laravel documentation: https://laravel.com/docs
- Review application logs
- Contact hosting support for server issues

## Conclusion

Your DMDI Magazine website should now be live and fully functional with multi-language support. Test all features thoroughly and monitor for any issues in the first few days after deployment.
