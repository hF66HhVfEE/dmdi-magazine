<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DMDI Magazine')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts - Esquire Style -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #000000;
            --secondary-color: #666666;
            --accent-color: #d4af37;
            --bg-light: #f8f9fa;
            --border-color: #e0e0e0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--primary-color);
            line-height: 1.6;
            background: #fff;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }
        
        /* Top Bar */
        .top-bar {
            background: var(--primary-color);
            color: white;
            padding: 8px 0;
            font-size: 0.85rem;
        }
        
        .top-bar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }
        
        .top-bar a:hover {
            color: var(--accent-color);
        }
        
        /* Main Header */
        .main-header {
            border-bottom: 1px solid var(--border-color);
            background: white;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--primary-color);
            text-decoration: none;
            letter-spacing: 2px;
        }
        
        .logo:hover {
            color: var(--primary-color);
        }
        
        /* Language Switcher */
        .language-switcher {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .language-switcher a {
            padding: 4px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            text-decoration: none;
            color: var(--primary-color);
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .language-switcher a:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .language-switcher a.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        /* Navigation */
        .main-nav {
            border-bottom: 1px solid var(--border-color);
            background: white;
        }
        
        .main-nav .nav-link {
            font-weight: 500;
            color: var(--primary-color);
            padding: 1rem 1.5rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .main-nav .nav-link:hover {
            color: var(--accent-color);
            border-bottom-color: var(--accent-color);
        }
        
        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--primary-color);
        }
        
        /* Article Cards */
        .article-card {
            transition: transform 0.2s ease;
            border: none;
        }
        
        .article-card:hover {
            transform: translateY(-2px);
        }
        
        .article-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            line-height: 1.2;
        }
        
        /* Ad Spaces */
        .ad-space {
            background: var(--bg-light);
            border: 1px dashed var(--border-color);
            padding: 40px 20px;
            text-align: center;
            margin: 30px 0;
        }
        
        .ad-space-text {
            color: var(--secondary-color);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Footer */
        .main-footer {
            background: #1a1a1a;
            color: #fff;
            padding-top: 60px;
            margin-top: 80px;
        }
        
        .footer-section {
            margin-bottom: 30px;
        }
        
        .footer-section h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-section ul li {
            margin-bottom: 10px;
        }
        
        .footer-section a {
            color: #ccc;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        
        .footer-section a:hover {
            color: var(--accent-color);
        }
        
        .footer-bottom {
            border-top: 1px solid #333;
            padding: 20px 0;
            margin-top: 40px;
        }
        
        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border-radius: 50%;
            background: #333;
            color: white;
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .logo {
                font-size: 1.8rem;
            }
            
            .main-nav {
                display: none;
            }
            
            .main-nav.show {
                display: block;
            }
            
            .main-nav .nav-link {
                display: block;
                padding: 0.75rem 0;
                border-bottom: 1px solid var(--border-color);
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .language-switcher {
                margin-top: 10px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span><i class="bi bi-calendar3"></i> {{ date('l, F d, Y') }}</span>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-6 col-md-4">
                    <a href="{{ url('/' . app()->getLocale()) }}" class="logo">
                        DMDI
                    </a>
                </div>
                <div class="col-6 col-md-8 text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <div class="language-switcher me-3">
                            <a href="{{ url('/id' . (request()->path() !== '/' && request()->path() !== 'id' && request()->path() !== 'en' ? '/' . substr(request()->path(), 3) : '')) }}" 
                               class="{{ app()->getLocale() == 'id' ? 'active' : '' }}">ID</a>
                            <a href="{{ url('/en' . (request()->path() !== '/' && request()->path() !== 'id' && request()->path() !== 'en' ? '/' . substr(request()->path(), 3) : '')) }}" 
                               class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
                        </div>
                        <span class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                            <i class="bi bi-list"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="main-nav" id="mainNav">
        <div class="container">
            <div class="d-md-flex justify-content-center">
                @php
                    $categories = \App\Models\Category::where('is_active', true)->get();
                    $locale = app()->getLocale();
                @endphp
                <a href="{{ url('/' . $locale) }}" class="nav-link">
                    {{ $locale == 'id' ? 'Beranda' : 'Home' }}
                </a>
                @foreach($categories as $category)
                <a href="{{ url('/' . $locale . '/category/' . $category->slug) }}" class="nav-link">
                    {{ $locale == 'id' ? $category->name_id : $category->name_en }}
                </a>
                @endforeach
            </div>
        </div>
    </nav>

    <!-- Ad Space - Top Banner -->
    <div class="container">
        <div class="ad-space mt-4">
            <span class="ad-space-text">Advertisement</span>
            <div class="mt-2">
                <small class="text-muted">728x90</small>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-section">
                    <h5>DMDI Magazine</h5>
                    <p class="text-muted" style="font-size: 0.9rem;">
                        {{ app()->getLocale() == 'id' 
                           ? 'Sumber berita dan informasi terpercaya dengan jangkauan global dan perspektif lokal.' 
                           : 'Trusted source of news and information with global reach and local perspective.' }}
                    </p>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-2 footer-section">
                    <h5>{{ app()->getLocale() == 'id' ? 'Kategori' : 'Categories' }}</h5>
                    <ul>
                        @foreach($categories->take(5) as $category)
                        <li>
                            <a href="{{ url('/' . app()->getLocale() . '/category/' . $category->slug) }}">
                                {{ app()->getLocale() == 'id' ? $category->name_id : $category->name_en }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3 footer-section">
                    <h5>{{ app()->getLocale() == 'id' ? 'Tentang Kami' : 'About Us' }}</h5>
                    <ul>
                        <li><a href="#">{{ app()->getLocale() == 'id' ? 'Tentang' : 'About' }}</a></li>
                        <li><a href="#">{{ app()->getLocale() == 'id' ? 'Kontak' : 'Contact' }}</a></li>
                        <li><a href="#">{{ app()->getLocale() == 'id' ? 'Tim Redaksi' : 'Editorial Team' }}</a></li>
                        <li><a href="#">{{ app()->getLocale() == 'id' ? 'Karir' : 'Careers' }}</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-section">
                    <h5>{{ app()->getLocale() == 'id' ? 'Berlangganan' : 'Subscribe' }}</h5>
                    <p class="text-muted" style="font-size: 0.85rem;">
                        {{ app()->getLocale() == 'id' 
                           ? 'Dapatkan newsletter mingguan kami' 
                           : 'Get our weekly newsletter' }}
                    </p>
                    <form class="mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email" style="background: #333; border: none; color: white;">
                            <button class="btn btn-light" type="submit">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted" style="font-size: 0.85rem;">
                            &copy; {{ date('Y') }} DMDI Magazine. {{ app()->getLocale() == 'id' ? 'Hak Cipta Dilindungi.' : 'All Rights Reserved.' }}
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="me-3">{{ app()->getLocale() == 'id' ? 'Kebijakan Privasi' : 'Privacy Policy' }}</a>
                        <a href="#">{{ app()->getLocale() == 'id' ? 'Syarat & Ketentuan' : 'Terms & Conditions' }}</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleMobileMenu() {
            document.getElementById('mainNav').classList.toggle('show');
        }
    </script>
    
    @stack('scripts')
</body>
</html>