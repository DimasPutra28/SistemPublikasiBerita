<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'wpvo_posts';
    protected $fillable = [
        'post_author',
        'post_date',
        'post_date_gmt',
        'post_content',
        'post_title',
        'post_excerpt',
        'post_status',
        'comment_status',
        'ping_status',
        'post_password',
        'post_name',
        'to_ping',
        'pinged',
        'post_modified',
        'post_modified_gmt',
        'post_content_filtered',
        'post_parent',
        'guid',
        'menu_order',
        'post_type',
        'post_mime_type',
        'comment_count',
        
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'post_author'); // Asumsi 'post_author' adalah kolom foreign key di tabel posts
    }
    // protected $casts = [
    //     'post_date' => 'datetime',
    //     'post_date_gmt' => 'datetime',
    //     'post_modified' => 'datetime',
    //     'post_modified_gmt' => 'datetime',
    // ];
}
