# DMDI Magazine - Testing Guide

## Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 16 or higher
- SQLite (for development)
- MySQL/MariaDB (for production)

## Local Development Setup

### 1. Clone Repository

```bash
git clone <repository-url>
cd dmdi-magazine
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

```bash
# Create SQLite database
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed database with dummy data
php artisan db:seed
```

### 5. Build Assets

```bash
# For development
npm run dev

# For production
npm run build
```

### 6. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Testing the Multi-Language Feature

### Test Language Switching

1. **Access Indonesian Version:**
   - Navigate to `http://localhost:8000/id`
   - Verify all content is in Indonesian
   - Check navigation menu, footer, and article content

2. **Access English Version:**
   - Navigate to `http://localhost:8000/en`
   - Verify all content is in English
   - Check navigation menu, footer, and article content

3. **Test Language Switcher:**
   - Click "EN" button in header to switch to English
   - Click "ID" button in header to switch to Indonesian
   - Verify URL changes and content updates

### Test Pages

1. **Homepage (`/id` or `/en`):**
   - Hero featured article displays correctly
   - Latest articles grid shows 6 articles
   - Category sections display articles by category
   - Ad spaces are visible
   - All content is in the correct language

2. **Article Page (`/id/article/{slug}` or `/en/article/{slug}`):**
   - Article content displays correctly
   - Meta information (author, date, views) is visible
   - Sidebar shows newsletter signup
   - Sidebar shows ad space (300x250)
   - Footer displays correctly
   - Language switcher maintains article context

3. **Category Page (`/id/category/{slug}` or `/en/category/{slug}`):**
   - Category header with gradient background
   - List of articles in the category
   - Sidebar with popular articles
   - Sidebar with category list
   - Sidebar ad space
   - Pagination works correctly

### Test Responsive Design

1. **Desktop (1920x1080):**
   - All elements properly aligned
   - Grid layout displays 3 columns
   - Navigation menu horizontal

2. **Tablet (768x1024):**
   - Grid adjusts to 2 columns
   - Navigation remains accessible
   - Ad spaces resize appropriately

3. **Mobile (375x667):**
   - Grid becomes single column
   - Mobile menu toggle appears
   - Logo and language switcher stack properly
   - All content remains readable

### Test Navigation

1. **Header Navigation:**
   - Logo links to homepage
   - All category links work
   - Language switcher works on all pages

2. **Footer Navigation:**
   - Category links work
   - About Us links (placeholders)
   - Social media icons (placeholders)
   - Newsletter form present

## Admin Panel Testing

### Access Admin Panel

1. **Create Admin User:**
   ```bash
   php artisan tinker
   ```
   
   Then in tinker:
   ```php
   \App\Models\User::create([
       'name' => 'Admin',
       'email' => 'admin@dmdi.com',
       'password' => bcrypt('password123'),
       'is_admin' => true
   ]);
   ```

2. **Login:**
   - Navigate to `http://localhost:8000/admin/login`
   - Email: admin@dmdi.com
   - Password: password123

3. **Test Admin Features:**
   - View article list
   - Create new article with bilingual content
   - Edit existing article
   - Delete article
   - Upload featured image

## Database Seeder Content

The seeder creates:
- 5 categories (Politik, Budaya, Gaya Hidup, Teknologi, Bisnis)
- 6 articles with full bilingual content
- Each article has:
  - Indonesian title, excerpt, and content
  - English title, excerpt, and content
  - Author, category, and metadata

## Common Issues and Solutions

### Issue: Page not found
**Solution:** Make sure you're accessing `/id` or `/en` routes, not just `/`

### Issue: Styles not loading
**Solution:** Run `npm run build` to compile assets

### Issue: Database errors
**Solution:** 
```bash
php artisan migrate:fresh --seed
```

### Issue: Permission denied
**Solution:** 
```bash
chmod -R 775 storage bootstrap/cache
```

## Performance Testing

1. **Check Page Load Time:**
   - Homepage should load in < 2 seconds
   - Article pages should load in < 1.5 seconds

2. **Test Database Queries:**
   ```bash
   php artisan tinker
   \DB::enableQueryLog();
   # Navigate to pages
   \DB::getQueryLog();
   ```

3. **Check Asset Sizes:**
   - CSS should be < 50KB
   - JS should be < 100KB

## Browser Compatibility

Test on:
- Google Chrome (latest)
- Mozilla Firefox (latest)
- Safari (latest)
- Microsoft Edge (latest)
- Mobile browsers (iOS Safari, Chrome Android)

## Accessibility Testing

- Test keyboard navigation
- Verify proper heading hierarchy
- Check color contrast
- Test with screen reader

## Next Steps

After local testing is successful:
1. Test on staging environment
2. Perform security audit
3. Optimize images and assets
4. Configure caching
5. Set up production environment
