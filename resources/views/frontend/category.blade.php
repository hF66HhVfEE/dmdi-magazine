@extends('layouts.frontend')

@section('title', (app()->getLocale() == 'id' ? $category->name_id : $category->name_en) . ' - DMDI Magazine')

@push('styles')
<style>
    .category-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 50px;
    }
    
    .category-header h1 {
        font-size: 3rem;
        margin-bottom: 15px;
    }
    
    .category-header p {
        font-size: 1.2rem;
        opacity: 0.9;
    }
    
    .article-list-item {
        border-bottom: 1px solid var(--border-color);
        padding: 30px 0;
        transition: all 0.3s;
    }
    
    .article-list-item:hover {
        transform: translateX(10px);
    }
    
    .article-list-item:last-child {
        border-bottom: none;
    }
    
    .article-list-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .article-list-content h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }
    
    .article-list-content a {
        color: var(--primary-color);
        text-decoration: none;
    }
    
    .article-list-content a:hover {
        color: var(--accent-color);
    }
    
    @media (max-width: 768px) {
        .category-header h1 {
            font-size: 2rem;
        }
        
        .article-list-image {
            height: 150px;
            margin-bottom: 15px;
        }
    }
</style>
@endpush

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <h1>{{ app()->getLocale() == 'id' ? $category->name_id : $category->name_en }}</h1>
        <p>{{ app()->getLocale() == 'id' ? $category->description_id : $category->description_en }}</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            @if($articles->count() > 0)
                @foreach($articles as $article)
                <div class="article-list-item">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ url(app()->getLocale() . '/article/' . $article->slug) }}">
                                @if($article->featured_image)
                                    <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                         alt="{{ app()->getLocale() == 'id' ? $article->title_id : $article->title_en }}" 
                                         class="article-list-image">
                                @else
                                    <div class="article-list-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                                @endif
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="article-list-content">
                                <div class="article-meta mb-2">
                                    <span class="text-muted">
                                        <i class="bi bi-person"></i> {{ $article->author }}
                                    </span>
                                    &nbsp;&nbsp;
                                    <span class="text-muted">
                                        <i class="bi bi-clock"></i> {{ $article->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                                
                                <h3>
                                    <a href="{{ url(app()->getLocale() . '/article/' . $article->slug) }}">
                                        {{ app()->getLocale() == 'id' ? $article->title_id : $article->title_en }}
                                    </a>
                                </h3>
                                
                                <p class="text-muted">
                                    {{ \Illuminate\Support\Str::limit(app()->getLocale() == 'id' ? $article->excerpt_id : $article->excerpt_en, 150) }}
                                </p>
                                
                                <a href="{{ url(app()->getLocale() . '/article/' . $article->slug) }}" class="btn btn-sm btn-outline-dark">
                                    {{ app()->getLocale() == 'id' ? 'Baca Selengkapnya' : 'Read More' }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- Pagination -->
                <div class="mt-5">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <h4 class="text-muted">{{ app()->getLocale() == 'id' ? 'Belum ada artikel dalam kategori ini' : 'No articles in this category yet' }}</h4>
                </div>
            @endif
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Ad Space -->
            <div class="ad-space mb-4">
                <span class="ad-space-text">Advertisement</span>
                <div class="mt-2">
                    <small class="text-muted">300x250</small>
                </div>
            </div>
            
            <!-- Popular Articles -->
            @php
                $popularArticles = \App\Models\Article::where('is_published', true)
                    ->orderBy('view_count', 'desc')
                    ->take(5)
                    ->get();
            @endphp
            
            @if($popularArticles->count() > 0)
            <div class="sidebar-widget mb-4">
                <h4 class="mb-4" style="font-family: 'Playfair Display', serif; font-weight: 700;">
                    {{ app()->getLocale() == 'id' ? 'Artikel Populer' : 'Popular Articles' }}
                </h4>
                
                @foreach($popularArticles as $popularArticle)
                <div class="mb-3 pb-3 border-bottom">
                    <a href="{{ url(app()->getLocale() . '/article/' . $popularArticle->slug) }}" class="text-decoration-none">
                        <h6 style="font-family: 'Playfair Display', serif; font-weight: 700; color: var(--primary-color);">
                            {{ app()->getLocale() == 'id' ? $popularArticle->title_id : $popularArticle->title_en }}
                        </h6>
                        <small class="text-muted">
                            <i class="bi bi-eye"></i> {{ $popularArticle->view_count }} {{ app()->getLocale() == 'id' ? 'views' : 'views' }}
                        </small>
                    </a>
                </div>
                @endforeach
            </div>
            @endif
            
            <!-- Categories -->
            @php
                $allCategories = \App\Models\Category::where('is_active', true)->get();
            @endphp
            
            <div class="sidebar-widget">
                <h4 class="mb-4" style="font-family: 'Playfair Display', serif; font-weight: 700;">
                    {{ app()->getLocale() == 'id' ? 'Kategori' : 'Categories' }}
                </h4>
                
                <ul class="list-unstyled">
                    @foreach($allCategories as $cat)
                    <li class="mb-2">
                        <a href="{{ url(app()->getLocale() . '/category/' . $cat->slug) }}" 
                           class="text-decoration-none {{ $cat->id == $category->id ? 'fw-bold' : '' }}"
                           style="color: {{ $cat->id == $category->id ? 'var(--accent-color)' : 'var(--primary-color)' }};">
                            <i class="bi bi-folder"></i> {{ app()->getLocale() == 'id' ? $cat->name_id : $cat->name_en }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
