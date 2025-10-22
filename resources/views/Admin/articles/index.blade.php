@extends('admin.layouts.admin')

@section('title', 'Kelola Artikel - DMDI Admin')
@section('page-title', 'Kelola Artikel')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-newspaper me-2"></i>
            Daftar Artikel
        </h5>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Artikel Baru
        </a>
    </div>
    
    <div class="card-body">
        @if($articles->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Judul Artikel</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>QR Code</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                        <tr>
                            <td>
                                <div class="d-flex align-items-start">
                                    @if($article->featured_image)
                                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                             alt="{{ $article->title_id }}" 
                                             class="rounded me-3"
                                             style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center"
                                             style="width: 60px; height: 40px;">
                                            <i class="bi bi-image text-white"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong class="d-block">{{ $article->title_id }}</strong>
                                        <small class="text-muted">{{ Str::limit($article->excerpt_id, 50) }}</small>
                                        @if($article->is_featured)
                                            <span class="badge bg-warning ms-1">Featured</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $article->category->name_id ?? '-' }}</td>
                            <td>
                                @if($article->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>
                                @if($article->qr_code_path)
                                    <img src="{{ asset('storage/' . $article->qr_code_path) }}" 
                                         alt="QR Code" 
                                         style="width: 40px; height: 40px;"
                                         class="rounded border"
                                         data-bs-toggle="tooltip" 
                                         title="QR Code untuk versi Inggris">
                                @else
                                    <button class="btn btn-sm btn-outline-primary generate-qr" 
                                            data-article-id="{{ $article->id }}"
                                            data-bs-toggle="tooltip"
                                            title="Generate QR Code">
                                        <i class="bi bi-qr-code"></i>
                                    </button>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $article->created_at->format('d/m/Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ url('id/article/' . $article->slug) }}" 
                                       target="_blank"
                                       class="btn btn-outline-success"
                                       data-bs-toggle="tooltip"
                                       title="Lihat Artikel">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('articles.edit', $article->id) }}" 
                                       class="btn btn-outline-primary"
                                       data-bs-toggle="tooltip"
                                       title="Edit Artikel">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('articles.destroy', $article->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Hapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger"
                                                data-bs-toggle="tooltip"
                                                title="Hapus Artikel">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Menampilkan {{ $articles->firstItem() }} - {{ $articles->lastItem() }} dari {{ $articles->total() }} artikel
                </div>
                {{ $articles->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <h5 class="text-muted mt-3">Belum ada artikel</h5>
                <p class="text-muted">Mulai dengan membuat artikel pertama Anda</p>
                <a href="{{ route('articles.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>
                    Buat Artikel Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    // QR Code Generation
    $('.generate-qr').on('click', function() {
        const button = $(this);
        const articleId = button.data('article-id');
        
        button.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i>');
        
        $.ajax({
            url: '/admin/articles/' + articleId + '/generate-qr',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Replace button with QR image
                    button.replaceWith(
                        '<img src="' + response.qr_url + '" alt="QR Code" style="width: 40px; height: 40px;" class="rounded border">'
                    );
                    
                    // Show success message
                    alert('QR Code berhasil digenerate!');
                }
            },
            error: function() {
                button.prop('disabled', false).html('<i class="bi bi-qr-code"></i>');
                alert('Error generating QR code. Please try again.');
            }
        });
    });
});
</script>
@endpush