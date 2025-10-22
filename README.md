# DMDI Magazine

A modern, bilingual (Indonesian/English) magazine website built with Laravel 12, featuring an Esquire.com-inspired design.

## Features

- **Bilingual Support**: Full content available in Indonesian (ID) and English (EN)
- **Modern Design**: Clean, professional layout inspired by Esquire.com
- **Responsive**: Works perfectly on desktop, tablet, and mobile devices
- **Category System**: Organized content across multiple categories
- **Article Management**: Full CRUD functionality for articles
- **Ad Spaces**: Strategic placement of advertisement areas
- **SEO Friendly**: Clean URLs and proper meta tags
- **Easy Navigation**: Intuitive header and footer navigation
- **Language Switcher**: Seamless switching between Indonesian and English

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS 4, Bootstrap 5, jQuery
- **Database**: MySQL/SQLite
- **PHP**: 8.2+
- **Node.js**: 16+

## Quick Start

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 16 or higher
- MySQL or SQLite

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd dmdi-magazine
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   
   For SQLite (development):
   ```bash
   touch database/database.sqlite
   ```
   
   For MySQL, update `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=dmdi_magazine
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

8. **Access the application**
   - Indonesian: http://localhost:8000/id
   - English: http://localhost:8000/en

## Documentation

- [Testing Guide](TESTING_GUIDE.md) - Complete guide for testing the application
- [Deployment Guide](DEPLOYMENT_GUIDE.md) - Step-by-step guide for deploying to cPanel

## Database Structure

### Categories
- Multiple categories with bilingual names and descriptions
- Slug-based URLs

### Articles
- Bilingual content (title, excerpt, content)
- Featured images
- Category association
- Author information
- View counter
- Published/featured status
- QR code support

### Users
- Admin authentication
- Article management

## Key Features Explained

### Multi-Language System

The application uses a locale-based routing system:
- URLs are prefixed with language code (`/id` or `/en`)
- Language switcher in header maintains context
- All content (UI and database) supports both languages
- Middleware handles locale switching automatically

### Categories

Pre-configured categories:
- Politik (Politics)
- Budaya (Culture)
- Gaya Hidup (Lifestyle)
- Teknologi (Technology)
- Bisnis (Business)

### Ad Spaces

Strategic ad placements:
- Top banner (728x90)
- Mid-page banners (970x250)
- Sidebar ads (300x250)
- Easy to integrate with ad networks

## Admin Panel

Access: http://localhost:8000/admin/login

Create admin user:
```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@dmdi.com',
    'password' => bcrypt('password123'),
    'is_admin' => true
]);
```

## Development

### Project Structure

```
dmdi-magazine/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Application controllers
│   │   └── Middleware/      # Custom middleware
│   └── Models/              # Eloquent models
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/             # Database seeders
├── resources/
│   └── views/
│       ├── layouts/         # Layout templates
│       └── frontend/        # Frontend views
├── routes/
│   └── web.php             # Web routes
└── public/                 # Public assets
```

### Adding New Languages

To add a new language:
1. Add language code to locale middleware
2. Update route constraints
3. Add database fields for new language
4. Update models with accessor methods
5. Update views with language conditions

## Production Deployment

See [DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md) for complete deployment instructions for cPanel hosting.

Key steps:
1. Build production assets (`npm run build`)
2. Configure environment variables
3. Set up database
4. Configure web server
5. Set proper file permissions
6. Enable caching

## Performance

- Optimized database queries with eager loading
- Asset compilation and minification
- Route and config caching in production
- Database query optimization

## Security

- CSRF protection on all forms
- Password hashing with bcrypt
- SQL injection protection via Eloquent ORM
- XSS prevention in Blade templates
- Environment variables for sensitive data

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License.

## Support

For issues and questions:
- Check the [Testing Guide](TESTING_GUIDE.md)
- Review the [Deployment Guide](DEPLOYMENT_GUIDE.md)
- Check application logs in `storage/logs/`

## Credits

Built with Laravel 12 and modern web technologies.
Design inspired by Esquire.com.
