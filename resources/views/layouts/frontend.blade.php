<!DOCTYPE html>
<html lang="{{ $locale ?? 'id' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DMDI Magazine')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts - Mirip Esquire -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1a1a1a;
            --secondary-color: #666;
            --accent-color: #d4af37;
            --bg-light: #f8f9fa;
        }
        
        body {
            font-family: 'Source Sans Pro', sans-serif;
            color: var(--primary-color);
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }
        
        /* Header Styles */
        .main-header {
            border-bottom: 1px solid #eaeaea;
            background: white;
        }
        
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }
        
        /* Navigation */
        .main-nav .nav-link {
            font-weight: 600;
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }
        
        .main-nav .nav-link:hover {
            color: var(--accent-color);
        }
        
        /* Article Cards */
        .article-card {
            transition: transform 0.2s ease;
        }
        
        .article-card:hover {
            transform: translateY(-2px);
        }
        
        .article-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            line-height: 1.2;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-md-4">
                    <a href="{{ url('/' . ($locale ?? 'id')) }}" class="logo">
                        DMDI
                    </a>
                </div>
                <div class="col-md-8">
                    <!-- Navigation akan kita tambahkan di step berikutnya -->
                    <nav class="main-nav d-flex justify-content-end">
                        <a href="{{ url('/' . ($locale ?? 'id')) }}" class="nav-link">Home</a>
                        <a href="#" class="nav-link">Politics</a>
                        <a href="#" class="nav-link">Culture</a>
                        <a href="#" class="nav-link">Lifestyle</a>
                    </nav>
                </div>
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
                <div class="col-md-6">
                    <h5 class="logo">DMDI Magazine</h5>
                    <p class="mt-3">Media terpercaya untuk berita dan informasi terkini dalam Bahasa Indonesia dan English.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; 2024 DMDI Magazine. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>