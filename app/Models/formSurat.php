<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formSurat extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'form_surat';
    protected $fillable = ['kodeForm','noTerbitan', 'tglEfektif', 'id_cabang', 'id_nik'];
}
