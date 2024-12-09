<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'slug',
        'image',
        'meta_description',
        'sumber',
        'views',
        'is_published',
        'published_at',
    ];

    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 100);
    }

    public function getReadingTimeAttribute()
    {
        // $mins = round(str_word_count($this->content) / 250);
        // return ($mins < 1) ? 1 . ' min read' : $mins . ' min read';
        return ceil(str_word_count(strip_tags($this->content)) / 250);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'article_tags', 'article_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comentar::class);
    }
}
