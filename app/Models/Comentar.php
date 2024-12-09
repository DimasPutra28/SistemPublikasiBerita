<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentar extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'parent_id', 'name_visitor', 'email_visitor', 'comment', 'is_published'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function balasan()
    {
        return $this->hasMany(Comentar::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comentar::class, 'parent_id');
    }
}
