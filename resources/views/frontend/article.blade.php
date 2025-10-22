@extends('layouts.frontend')

@section('title', ($locale == 'id' ? $article->title_id : $article->title_en) . ' - DMDI Magazine')

@section('content')
<div class="article-detail-page">
    <div class="container">
        <div class="row">
            <!-- Main Article Content -->
            <div class="col-lg-8">
                <article class="main-article">
                    <!-- Article Header -->
                    <header class="article-header mb-5">
                        <!-- Category Badge -->
                        <div class="category-badge mb-3">
                            <span class="badge bg-secondary text-uppercase">
                                {{ $article->category->name_id ?? 'General' }}
                            </span>
                        </div>
                        
                        <!-- Article Title -->
                        <h1 class="article-title display-4 mb-4">
                            {{ $locale == 'id' ? $article->title_id : $article->title_en }}
                        </h1>
                        
                        <!-- Article Meta -->
                        <div class="article-meta mb-4">
                            <div class="d-flex flex-wrap align-items-center text-muted">
                                <span class="me-4">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $article->author }}
                                </span>
                                <span class="me-4">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $article->created_at->format('F d, Y') }}
                                </span>
                                <span>
                                    <i class="bi bi-eye me-1"></i>
                                    {{ rand(100, 1000) }} views
                                </span>
                            </div>
                        </div>
                        
                        <!-- Featured Image -->
                        @if($article->featured_image)
                        <div class="featured-image mb-5">
                            <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                 alt="{{ $locale == 'id' ? $article->title_id : $article->title_en }}" 
                                 class="img-fluid w-100 rounded">
                            @if($article->featured_image_caption)
                            <div class="image-caption text-center text-muted mt-2 small">
                                {{ $article->featured_image_caption }}
                            </div>
                            @endif
                        </div>
                        @endif
                        
                        <!-- Article Excerpt -->
                        <div class="article-excerpt lead mb-4">
                            <p class="text-muted">
                                {{ $locale == 'id' ? $article->excerpt_id : $article->excerpt_en }}
                            </p>
                        </div>
                    </header>

                    <!-- Article Content -->
                    <div class="article-content">
                        <div class="content-body">
                            {!! $locale == 'id' ? $article->content_id : $article->content_en !!}
                        </div>
                    </div>

                    <!-- Article Footer -->
                    <footer class="article-footer mt-5 pt-4 border-top">
                        <!-- Tags -->
                        <div class="article-tags mb-4">
                            <strong class="me-2">{{ $locale == 'id' ? 'Tags:' : 'Tags:' }}</strong>
                            <span class="badge bg-light text-dark me-2">#{{ $article->category->name_id ?? 'News' }}</span>
                            <span class="badge bg-light text-dark me-2">#{{ $article->author }}</span>
                        </div>
                        
                        <!-- Share Buttons -->
                        <div class="share-buttons mb-4">
                            <strong class="me-3">{{ $locale == 'id' ? 'Bagikan:' : 'Share:' }}</strong>
                            <button class="btn btn-outline-secondary btn-sm me-2">
                                <i class="bi bi-facebook"></i> Facebook
                            </button>
                            <button class="btn btn-outline-secondary btn-sm me-2">
                                <i class="bi bi-twitter"></i> Twitter
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-link-45deg"></i> Copy Link
                            </button>
                        </div>
                    </footer>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="sidebar">
                    <!-- Newsletter Signup -->
                    <div class="sidebar-widget mb-5">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-3">
                                    {{ $locale == 'id' ? 'Berlangganan Newsletter' : 'Subscribe to Newsletter' }}
                                </h5>
                                <p class="card-text small text-muted mb-3">
                                    {{ $locale == 'id' 
                                       ? 'Dapatkan update terbaru langsung di inbox Anda' 
                                       : 'Get the latest updates directly in your inbox' 
                                    }}
                                </p>
                                <form class="newsletter-form">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Email" required>
                                        <button class="btn btn-primary" type="submit">
                                            {{ $locale == 'id' ? 'Daftar' : 'Subscribe' }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Related Articles -->
                    @if($relatedArticles->count() > 0)
                    <div class="sidebar-widget mb-5">
                        <h4 class="widget-title mb-4">
                            {{ $locale == 'id' ? 'Artikel Terkait' : 'Related Articles' }}
                        </h4>
                        
                        @foreach($relatedArticles as $relatedArticle)
                        <div class="related-article mb-4">
                            <a href="{{ url($locale . '/article/' . $relatedArticle->slug) }}" 
                               class="text-decoration-none text-dark">
                                @if($relatedArticle->featured_image)
                                <div class="related-image mb-2">
                                    <img src="{{ asset('storage/' . $relatedArticle->featured_image) }}" 
                                         alt="{{ $locale == 'id' ? $relatedArticle->title_id : $relatedArticle->title_en }}" 
                                         class="img-fluid rounded" style="height: 80px; object-fit: cover;">
                                </div>
                                @endif
                                
                                <h6 class="related-title mb-2">
                                    {{ $locale == 'id' ? $relatedArticle->title_id : $relatedArticle->title_en }}
                                </h6>
                                
                                <div class="related-meta text-muted small">
                                    <span>{{ $relatedArticle->created_at->format('M d') }}</span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Ad Space -->
                    <div class="sidebar-widget">
                        <div class="ad-space bg-light border rounded p-4 text-center">
                            <small class="text-muted d-block mb-2">ADVERTISEMENT</small>
                            <div class="ad-content bg-white border rounded p-3">
                                <p class="mb-2">Your Ad Here</p>
                                <small class="text-muted">300x250</small>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

<style>
.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.article-content p {
    margin-bottom: 1.5rem;
}

.article-content h2, 
.article-content h3, 
.article-content h4 {
    margin: 2rem 0 1rem 0;
    font-family: 'Playfair Display', serif;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
}

.article-content blockquote {
    border-left: 4px solid var(--accent-color);
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: var(--secondary-color);
}

.article-content ul, 
.article-content ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.widget-title {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 1.25rem;
    border-bottom: 2px solid var(--accent-color);
    padding-bottom: 0.5rem;
}

.related-title {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    line-height: 1.3;
    font-size: 0.95rem;
}
</style>
@endsection