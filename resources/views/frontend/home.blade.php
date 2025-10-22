@extends('layouts.frontend')

@section('title', $locale == 'id' ? 'Beranda - DMDI Magazine' : 'Home - DMDI Magazine')

@section('content')
<!-- Hero Section -->
<section class="hero-section py-5 bg-light">
    <div class="container">
        @if($featuredArticles->count() > 0)
        <div class="row">
            <div class="col-lg-8">
                <!-- Main Featured Article -->
                @php $mainFeatured = $featuredArticles->first(); @endphp
                <div class="main-featured-article">
                    <a href="{{ url($locale . '/article/' . $mainFeatured->slug) }}" class="text-decoration-none text-dark">
                        @if($mainFeatured->featured_image)
                        <div class="featured-image mb-4">
                            <img src="{{ asset('storage/' . $mainFeatured->featured_image) }}" 
                                 alt="{{ $locale == 'id' ? $mainFeatured->title_id : $mainFeatured->title_en }}" 
                                 class="img-fluid w-100 rounded">
                        </div>
                        @endif
                        
                        <div class="article-meta mb-2">
                            <span class="text-muted small">
                                <i class="bi bi-clock me-1"></i>
                                {{ $mainFeatured->created_at->format('M d, Y') }}
                            </span>
                            <span class="text-muted small ms-3">
                                <i class="bi bi-person me-1"></i>
                                {{ $mainFeatured->author }}
                            </span>
                        </div>
                        
                        <h1 class="article-title display-5 mb-3">
                            {{ $locale == 'id' ? $mainFeatured->title_id : $mainFeatured->title_en }}
                        </h1>
                        
                        <p class="lead text-muted">
                            {{ $locale == 'id' ? $mainFeatured->excerpt_id : $mainFeatured->excerpt_en }}
                        </p>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Side Featured Articles -->
                <div class="side-featured-articles">
                    <h4 class="mb-4">{{ $locale == 'id' ? 'Artikel Unggulan' : 'Featured Articles' }}</h4>
                    
                    @foreach($featuredArticles->skip(1) as $article)
                    <div class="side-article mb-4 pb-4 border-bottom">
                        <a href="{{ url($locale . '/article/' . $article->slug) }}" class="text-decoration-none text-dark">
                            @if($article->featured_image)
                            <div class="side-image mb-3">
                                <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                     alt="{{ $locale == 'id' ? $article->title_id : $article->title_en }}" 
                                     class="img-fluid rounded">
                            </div>
                            @endif
                            
                            <h5 class="article-title h6 mb-2">
                                {{ $locale == 'id' ? $article->title_id : $article->title_en }}
                            </h5>
                            
                            <div class="article-meta">
                                <span class="text-muted small">
                                    {{ $article->created_at->format('M d') }}
                                </span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Latest Articles Section -->
<section class="latest-articles py-5">
    <div class="container">
        <div class="section-header mb-5">
            <h2 class="section-title">{{ $locale == 'id' ? 'Artikel Terbaru' : 'Latest Articles' }}</h2>
            <p class="text-muted">{{ $locale == 'id' ? 'Kumpulan artikel terbaru dari DMDI Magazine' : 'Latest articles from DMDI Magazine' }}</p>
        </div>
        
        <div class="row">
            @foreach($latestArticles as $article)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="article-card card border-0 h-100">
                    <a href="{{ url($locale . '/article/' . $article->slug) }}" class="text-decoration-none text-dark">
                        @if($article->featured_image)
                        <div class="card-img-top">
                            <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                 alt="{{ $locale == 'id' ? $article->title_id : $article->title_en }}" 
                                 class="img-fluid w-100" style="height: 200px; object-fit: cover;">
                        </div>
                        @endif
                        
                        <div class="card-body">
                            <div class="article-meta mb-2">
                                <span class="text-muted small">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $article->created_at->format('M d, Y') }}
                                </span>
                                <span class="text-muted small ms-2">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $article->author }}
                                </span>
                            </div>
                            
                            <h3 class="article-title h5 mb-3">
                                {{ $locale == 'id' ? $article->title_id : $article->title_en }}
                            </h3>
                            
                            <p class="card-text text-muted small">
                                {{ \Illuminate\Support\Str::limit($locale == 'id' ? $article->excerpt_id : $article->excerpt_en, 120) }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($latestArticles->count() == 0)
        <div class="text-center py-5">
            <h4 class="text-muted">{{ $locale == 'id' ? 'Belum ada artikel' : 'No articles yet' }}</h4>
            <p class="text-muted">{{ $locale == 'id' ? 'Silakan buat artikel pertama melalui admin panel' : 'Please create your first article through admin panel' }}</p>
        </div>
        @endif
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section py-5 bg-dark text-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h3 class="mb-3">{{ $locale == 'id' ? 'Berlangganan Newsletter' : 'Subscribe to Newsletter' }}</h3>
                <p class="mb-4">
                    {{ $locale == 'id' 
                       ? 'Dapatkan update terbaru dan artikel eksklusif langsung di inbox Anda' 
                       : 'Get the latest updates and exclusive articles directly in your inbox' 
                    }}
                </p>
                
                <form class="newsletter-form">
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control" placeholder="{{ $locale == 'id' ? 'Alamat email Anda' : 'Your email address' }}" required>
                        <button class="btn btn-primary" type="submit">
                            {{ $locale == 'id' ? 'Berlangganan' : 'Subscribe' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection