<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_temuan extends Model
{
    use HasFactory;

    protected $table = 'tb_temuan'; // nama tabel

    protected $fillable = [
        'id_hasilpengamatan',
        'nik',
        'deskripsi',
        'lokasi',
        'krisis',
        'prosedure',
        'elemen',
        'tanggal',
        'id_cabang',
        'status',
        'current_owner_id',
    ];

    // Relasi ke user (pemilik form)
    public function owner()
    {
        return $this->belongsTo(User::class, 'current_owner_id');
    }

    // Relasi ke hasil pengamatan
    public function hasilPengamatan()
    {
        return $this->belongsTo(Tb_hasilpengamatan::class, 'id_hasilpengamatan');
    }

    public function fotos()
    {
        return $this->hasMany(tb_foto_temuan::class, 'temuan_id');
    }

    public function penyelesaian()
    {
        return $this->hasOne(Tb_penyelesaian::class, 'temuan_id');
    }

    public function fotoPenyelesaian()
    {
        return $this->hasManyThrough(
            Tb_foto_penyelesaian::class,
            Tb_penyelesaian::class,
            'temuan_id', 'penyelesaian_id', 'id', 'id'
        );
    }


}
