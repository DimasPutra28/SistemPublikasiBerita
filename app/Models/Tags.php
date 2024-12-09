<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tags', 'tag_id', 'article_id');
    }
}
