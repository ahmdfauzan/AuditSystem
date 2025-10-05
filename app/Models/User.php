<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    protected $table = 'user'; // pastikan sesuai dengan nama tabel di database

    protected $fillable = [
        'name',
        'sistemManagement',
        'dept',
        'email',
        'password',
        'level',
        'nik',
        'cabang',
        'kode_cabang',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Tambahan: gunakan nik untuk login
    public function username()
    {
        return 'nik';
    }
}
