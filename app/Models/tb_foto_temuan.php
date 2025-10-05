<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_foto_temuan extends Model
{
    use HasFactory;
    protected $table = 'tb_foto_temuan';
    protected $fillable = ['temuan_id', 'foto'];

    public function temuan()
    {
    return $this->belongsTo(tb_temuan::class, 'temuan_id');
    }
}
