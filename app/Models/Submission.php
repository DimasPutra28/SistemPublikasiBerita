<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = ['submitter_name', 'submitter_email', 'submitter_phone', 'title', 'content', 'is_approved'];
}
