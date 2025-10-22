@extends('layouts.frontend')

@section('title', app()->getLocale() == 'id' ? 'Beranda - DMDI Magazine' : 'Home - DMDI Magazine')

@push('styles')
<style>
    .hero-featured {
        position: relative;
        margin-bottom: 60px;
    }
    
    .hero-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .hero-content {
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 40px;
        border-radius: 0 0 8px 8px;
    }
    
    .hero-content h1 {
        color: white;
        font-size: 2.5rem;
        margin-bottom: 15px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    
    .hero-content p {
        color: #e0e0e0;
        font-size: 1.1rem;
    }
    
    .category-badge {
        background: var(--accent-color);
        color: white;
        padding: 6px 15px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .article-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-bottom: 40px;
    }
    
    .article-card-home {
        border: none;
        transition: transform 0.3s;
    }
    
    .article-card-home:hover {
        transform: translateY(-5px);
    }
    
    .article-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    
    .article-meta {
        color: var(--secondary-color);
        font-size: 0.85rem;
        margin-bottom: 10px;
    }
    
    .article-card-home h3 {
        font-size: 1.25rem;
        line-height: 1.4;
        margin-bottom: 10px;
    }
    
    .article-card-home a {
        color: var(--primary-color);
        text-decoration: none;
    }
    
    .article-card-home a:hover {
        color: var(--accent-color);
    }
    
    .section-title {
        font-size: 2rem;
        margin-bottom: 40px;
        padding-bottom: 15px;
        border-bottom: 3px solid var(--primary-color);
        display: inline-block;
    }
    
    @media (max-width: 992px) {
        .article-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .hero-content h1 {
            font-size: 1.8rem;
        }
        
        .hero-image {
            height: 350px;
        }
    }
    
    @media (max-width: 576px) {
        .article-grid {
            grid-template-columns: 1fr;
        }
        
        .hero-content h1 {
            font-size: 1.5rem;
        }
        
        .hero-content {
            padding: 20px;
        }
        
        .hero-image {
            height: 300px;
        }
    }
</style>
@endpush

@section('content')
<div class="container mt-5">
    @if($featuredArticles->count() > 0)
    <!-- Hero Featured Article -->
    @php $mainFeatured = $featuredArticles->first(); @endphp
    <div class="hero-featured">
        <a href="{{ url(app()->getLocale() . '/article/' . $mainFeatured->slug) }}" class="text-decoration-none">
            @if($mainFeatured->featured_image)
                <img src="{{ asset('storage/' . $mainFeatured->featured_image) }}" 
                     alt="{{ app()->getLocale() == 'id' ? $mainFeatured->title_id : $mainFeatured->title_en }}" 
                     class="hero-image">
            @else
                <div class="hero-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
            @endif
            
            <div class="hero-content">
                <span class="category-badge">
                    {{ app()->getLocale() == 'id' ? $mainFeatured->category->name_id : $mainFeatured->category->name_en }}
                </span>
                <h1>{{ app()->getLocale() == 'id' ? $mainFeatured->title_id : $mainFeatured->title_en }}</h1>
                <p>{{ app()->getLocale() == 'id' ? $mainFeatured->excerpt_id : $mainFeatured->excerpt_en }}</p>
                <div class="article-meta" style="color: #e0e0e0;">
                    <i class="bi bi-person"></i> {{ $mainFeatured->author }} &nbsp;&nbsp;
                    <i class="bi bi-clock"></i> {{ $mainFeatured->created_at->format('M d, Y') }}
                </div>
            </div>
        </a>
    </div>
    @endif
    
    <!-- Ad Space - Mid Page -->
    <div class="ad-space my-5">
        <span class="ad-space-text">Advertisement</span>
        <div class="mt-2">
            <small class="text-muted">970x250</small>
        </div>
    </div>
    
    <!-- Latest Articles -->
    <section class="latest-articles-section mb-5">
        <h2 class="section-title">
            {{ app()->getLocale() == 'id' ? 'Artikel Terbaru' : 'Latest Articles' }}
        </h2>
        
        <div class="article-grid">
            @foreach($latestArticles->take(6) as $article)
            <div class="article-card-home">
                <a href="{{ url(app()->getLocale() . '/article/' . $article->slug) }}">
                    @if($article->featured_image)
                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
                             alt="{{ app()->getLocale() == 'id' ? $article->title_id : $article->title_en }}" 
                             class="article-image">
                    @else
                        <div class="article-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                    @endif
                    
                    <div class="article-meta">
                        <i class="bi bi-folder"></i> 
                        {{ app()->getLocale() == 'id' ? $article->category->name_id : $article->category->name_en }}
                        &nbsp;&nbsp;
                        <i class="bi bi-clock"></i> {{ $article->created_at->format('M d, Y') }}
                    </div>
                    
                    <h3>{{ app()->getLocale() == 'id' ? $article->title_id : $article->title_en }}</h3>
                    
                    <p class="text-muted" style="font-size: 0.95rem;">
                        {{ \Illuminate\Support\Str::limit(app()->getLocale() == 'id' ? $article->excerpt_id : $article->excerpt_en, 100) }}
                    </p>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    
    <!-- Ad Space - Bottom -->
    <div class="ad-space my-5">
        <span class="ad-space-text">Advertisement</span>
        <div class="mt-2">
            <small class="text-muted">970x250</small>
        </div>
    </div>
    
    <!-- More Articles by Category -->
    @php
        $categoriesWithArticles = \App\Models\Category::where('is_active', true)
            ->with(['articles' => function($q) {
                $q->where('is_published', true)->orderBy('created_at', 'desc')->take(3);
            }])
            ->get()
            ->filter(function($cat) { return $cat->articles->count() > 0; });
    @endphp
    
    @foreach($categoriesWithArticles->take(2) as $category)
    <section class="category-section mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0" style="border: none;">
                {{ app()->getLocale() == 'id' ? $category->name_id : $category->name_en }}
            </h2>
            <a href="{{ url(app()->getLocale() . '/category/' . $category->slug) }}" class="text-decoration-none">
                {{ app()->getLocale() == 'id' ? 'Lihat Semua' : 'View All' }} <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="article-grid">
            @foreach($category->articles as $article)
            <div class="article-card-home">
                <a href="{{ url(app()->getLocale() . '/article/' . $article->slug) }}">
                    @if($article->featured_image)
                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
                             alt="{{ app()->getLocale() == 'id' ? $article->title_id : $article->title_en }}" 
                             class="article-image">
                    @else
                        <div class="article-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                    @endif
                    
                    <div class="article-meta">
                        <i class="bi bi-person"></i> {{ $article->author }}
                        &nbsp;&nbsp;
                        <i class="bi bi-clock"></i> {{ $article->created_at->format('M d, Y') }}
                    </div>
                    
                    <h3>{{ app()->getLocale() == 'id' ? $article->title_id : $article->title_en }}</h3>
                    
                    <p class="text-muted" style="font-size: 0.95rem;">
                        {{ \Illuminate\Support\Str::limit(app()->getLocale() == 'id' ? $article->excerpt_id : $article->excerpt_en, 100) }}
                    </p>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endforeach
</div>
@endsection