<!DOCTYPE html>
<html lang="{{ $locale ?? 'id' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DMDI Magazine')</title>
    
    @yield('meta')
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts - Mirip Esquire -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1a1a1a;
            --secondary-color: #666;
            --accent-color: #c9a961;
            --bg-light: #fafafa;
            --border-color: #e5e5e5;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--primary-color);
            line-height: 1.7;
            background: #fff;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            line-height: 1.2;
        }
        
        /* Header Styles */
        .main-header {
            border-bottom: 1px solid var(--border-color);
            background: white;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
        
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--primary-color);
            text-decoration: none;
            letter-spacing: -1px;
        }
        
        /* Navigation */
        .main-nav {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .main-nav .nav-link {
            font-weight: 500;
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 1px;
            text-decoration: none;
            transition: color 0.2s ease;
            border-bottom: 2px solid transparent;
        }
        
        .main-nav .nav-link:hover {
            color: var(--accent-color);
            border-bottom-color: var(--accent-color);
        }
        
        /* Language Switcher */
        .lang-switcher {
            display: flex;
            gap: 0.25rem;
            align-items: center;
            margin-left: 1rem;
            padding-left: 1rem;
            border-left: 1px solid var(--border-color);
        }
        
        .lang-switcher .lang-btn {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--secondary-color);
            background: transparent;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        
        .lang-switcher .lang-btn:hover {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .lang-switcher .lang-btn.active {
            color: white;
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        /* Article Cards */
        .article-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--border-color);
            border-radius: 0;
            overflow: hidden;
        }
        
        .article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .article-card img {
            transition: transform 0.3s ease;
        }
        
        .article-card:hover img {
            transform: scale(1.05);
        }
        
        .article-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            line-height: 1.3;
        }
        
        .article-meta {
            font-size: 0.875rem;
            color: var(--secondary-color);
        }
        
        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block;
            }
            
            .main-nav {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 1rem;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            
            .main-nav.active {
                display: flex;
            }
            
            .lang-switcher {
                margin-left: 0;
                padding-left: 0;
                border-left: none;
                padding-top: 1rem;
                border-top: 1px solid var(--border-color);
            }
            
            .logo {
                font-size: 1.75rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between py-3">
                <a href="{{ url('/' . ($locale ?? 'id')) }}" class="logo">
                    DMDI
                </a>
                
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="bi bi-list"></i>
                </button>
                
                <nav class="main-nav" id="mainNav">
                    <a href="{{ url('/' . ($locale ?? 'id')) }}" class="nav-link">
                        {{ $locale == 'id' ? 'HOME' : 'HOME' }}
                    </a>
                    <a href="{{ url('/' . ($locale ?? 'id') . '#politics') }}" class="nav-link">
                        {{ $locale == 'id' ? 'POLITIK' : 'POLITICS' }}
                    </a>
                    <a href="{{ url('/' . ($locale ?? 'id') . '#culture') }}" class="nav-link">
                        {{ $locale == 'id' ? 'BUDAYA' : 'CULTURE' }}
                    </a>
                    <a href="{{ url('/' . ($locale ?? 'id') . '#lifestyle') }}" class="nav-link">
                        {{ $locale == 'id' ? 'GAYA HIDUP' : 'LIFESTYLE' }}
                    </a>
                    
                    <div class="lang-switcher">
                        <a href="{{ url('/id' . (Request::path() != '/' && Request::path() != 'id' && Request::path() != 'en' ? '/' . substr(Request::path(), 3) : '')) }}" 
                           class="lang-btn {{ $locale == 'id' ? 'active' : '' }}">
                            ID
                        </a>
                        <a href="{{ url('/en' . (Request::path() != '/' && Request::path() != 'id' && Request::path() != 'en' ? '/' . substr(Request::path(), 3) : '')) }}" 
                           class="lang-btn {{ $locale == 'en' ? 'active' : '' }}">
                            EN
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="logo text-light mb-3">DMDI Magazine</h5>
                    <p>{{ $locale == 'id' 
                        ? 'Media terpercaya untuk berita dan informasi terkini dalam Bahasa Indonesia dan English.' 
                        : 'Trusted media for the latest news and information in Indonesian and English.' }}
                    </p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h6 class="text-uppercase mb-3">{{ $locale == 'id' ? 'Kategori' : 'Categories' }}</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">{{ $locale == 'id' ? 'Politik' : 'Politics' }}</a></li>
                        <li><a href="#" class="text-light text-decoration-none">{{ $locale == 'id' ? 'Budaya' : 'Culture' }}</a></li>
                        <li><a href="#" class="text-light text-decoration-none">{{ $locale == 'id' ? 'Gaya Hidup' : 'Lifestyle' }}</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="text-uppercase mb-3">{{ $locale == 'id' ? 'Ikuti Kami' : 'Follow Us' }}</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-linkedin fs-5"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2024 DMDI Magazine. {{ $locale == 'id' ? 'Hak cipta dilindungi.' : 'All rights reserved.' }}</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuToggle')?.addEventListener('click', function() {
            document.getElementById('mainNav')?.classList.toggle('active');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const nav = document.getElementById('mainNav');
            const toggle = document.getElementById('mobileMenuToggle');
            
            if (nav && toggle && !nav.contains(event.target) && !toggle.contains(event.target)) {
                nav.classList.remove('active');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>