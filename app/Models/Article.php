<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = [
        'slug', 'title_id', 'title_en', 'excerpt_id', 'excerpt_en', 
        'content_id', 'content_en', 'featured_image', 'category_id',
        'author', 'view_count', 'is_published', 'is_featured', 'qr_code_path'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function getTitleAttribute()
    {
        return app()->getLocale() === 'en' ? $this->title_en : $this->title_id;
    }
    
    public function getContentAttribute()
    {
        return app()->getLocale() === 'en' ? $this->content_en : $this->content_id;
    }
    
    public function getExcerptAttribute()
    {
        return app()->getLocale() === 'en' ? $this->excerpt_en : $this->excerpt_id;
    }
}