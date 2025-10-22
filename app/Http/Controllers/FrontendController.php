<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function showArticle($locale, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        
        // Get related articles (same category)
        $relatedArticles = Article::where('category_id', $article->category_id)
                                ->where('id', '!=', $article->id)
                                ->where('is_published', true)
                                ->orderBy('created_at', 'desc')
                                ->take(4)
                                ->get();

        return view('frontend.article', compact('article', 'relatedArticles', 'locale'));
    }

    public function showCategory($locale, $slug)
    {
        $category = Category::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        $articles = Article::where('category_id', $category->id)
                          ->where('is_published', true)
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);

        return view('frontend.category', compact('category', 'articles', 'locale'));
    }
}