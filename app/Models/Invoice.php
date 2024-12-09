<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['submission_id', 'amount', 'issued_date'];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
