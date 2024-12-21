<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengirim extends Model
{
    protected $table = 'pengirims';
    protected $fillable = [
        'nama',
        'no_wa',
        'email',
        'judul_berita',
        'file_path',
        'tanggal',
        'paket',
        'bukti_bayar',
        'harga',
        'metodebayar',
    ];
}
