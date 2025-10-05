<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_penyelesaian extends Model
{
    use HasFactory;

    protected $table = 'tb_penyelesaian';

    protected $fillable = [
        'temuan_id',
        'identifikasi',
        'tindakanlangsung',
        'perbaikan',
        'tanggal',
        'targetPerbaikan',
        'id_cabang',
    ];

    public function fotoPenyelesaian()
    {
        return $this->hasMany(Tb_foto_penyelesaian::class, 'penyelesaian_id');
    }

    public function temuan()
    {
        return $this->belongsTo(Tb_temuan::class, 'temuan_id');
    }
}
