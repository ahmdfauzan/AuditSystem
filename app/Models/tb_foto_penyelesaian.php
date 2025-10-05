<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_foto_penyelesaian extends Model
{
    use HasFactory;

    protected $table = 'tb_foto_penyelesaian';

    protected $fillable = ['penyelesaian_id', 'foto'];

    public function penyelesaian()
    {
        return $this->belongsTo(Tb_penyelesaian::class, 'penyelesaian_id');
    }
}
