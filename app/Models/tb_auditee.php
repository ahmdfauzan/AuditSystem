<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_auditee extends Model
{
    use HasFactory;
        use HasFactory;
        protected $guarded = [];
        protected $table = 'tb_auditee';
        protected $fillable = ['name','nik', 'dept' ,'jabatan', 'id_cabang', 'fotoTtd'];

    public function hasilPengamatan()
    {
        return $this->hasMany(Tb_hasilpengamatan::class, 'namaAuditee', 'nik');
    }
}
