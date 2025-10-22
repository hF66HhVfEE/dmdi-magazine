<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
        
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'excerpt_id' => 'required|string|max:500',
            'excerpt_en' => 'required|string|max:500',
            'content_id' => 'required|string',
            'content_en' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:255',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        // Generate slug from Indonesian title
        $slug = Str::slug($validated['title_id']);
        $originalSlug = $slug;
        $counter = 1;

        // Ensure slug is unique
        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $validated['slug'] = $slug;

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = 'article-' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('articles', $filename, 'public');
            $validated['featured_image'] = $path;
        }

        Article::create($validated);

        return redirect()->route('articles.index')
                        ->with('success', 'Artikel berhasil dibuat!');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'excerpt_id' => 'required|string|max:500',
            'excerpt_en' => 'required|string|max:500',
            'content_id' => 'required|string',
            'content_en' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:255',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }

            $image = $request->file('featured_image');
            $filename = 'article-' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('articles', $filename, 'public');
            $validated['featured_image'] = $path;
        }

        $article->update($validated);

        return redirect()->route('articles.index')
                        ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        // Delete featured image if exists
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        // Delete QR code if exists
        if ($article->qr_code_path) {
            Storage::disk('public')->delete($article->qr_code_path);
        }

        $article->delete();

        return redirect()->route('articles.index')
                        ->with('success', 'Artikel berhasil dihapus!');
    }

    public function generateQR($id)
    {
        $article = Article::findOrFail($id);
        
        // Generate URLs for both languages
        $url_id = url('/id/article/' . $article->slug);
        $url_en = url('/en/article/' . $article->slug);
        
        // Create QR code for English version (for print magazine)
        $qrCode = QrCode::format('png')
                        ->size(300)
                        ->errorCorrection('H')
                        ->generate($url_en);
        
        $filename = 'qr-codes/article-' . $article->id . '-en.png';
        
        // Save QR code to storage
        Storage::disk('public')->put($filename, $qrCode);
        
        // Update article with QR code path
        $article->update(['qr_code_path' => $filename]);
        
        return response()->json([
            'success' => true,
            'message' => 'QR Code berhasil digenerate!',
            'qr_url' => asset('storage/' . $filename)
        ]);
    }
}