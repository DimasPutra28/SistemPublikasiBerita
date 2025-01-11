<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $table = 'wpvo_users'; // Nama tabel

    protected $primaryKey = 'ID'; // Kolom primary key

    protected $fillable = [
        'user_login',
        'password',
        'email',
        'user_nicename',
        'display_name',
        'user_status',
        'user_registered',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Sembunyikan kolom password
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    //     public function getAuthPassword()
    // {
    //     return $this->password; // Jika kolom password di database adalah 'password'
    // }

    // public function getAuthIdentifierName()
    // {
    //     return 'email'; // Ganti dengan nama kolom yang Anda gunakan
    // }



    // public function username()
    // {
    //     return 'email'; // Gunakan user_email sebagai username
    // }




}
