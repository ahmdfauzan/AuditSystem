<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_hasilpengamatan extends Model
{
    protected $table = 'tb_hasilpengamatan';
    protected $fillable = [
    'namaAudit', 'tanggal', 'kategori', 'catatan', 'kodeRoom', 'lokasi', 'id_cabang', 'status_final', 'namaAuditor', 'namaAuditee'
    ];


    // Relasi ke tb_temuan (satu hasil pengamatan bisa punya banyak temuan)
    public function temuan()
    {
        return $this->hasMany(Tb_temuan::class, 'id_hasilpengamatan');
    }

    public function roomAudit()
    {
        return $this->belongsTo(Tb_roomAudit::class, 'namaAudit', 'id');
    }
    // Relasi ke Auditor
    public function auditor()
    {
        return $this->belongsTo(Tb_auditor::class, 'namaAuditor', 'nik');
    }

    // Relasi ke Auditee
    public function auditee()
    {
        return $this->belongsTo(Tb_auditee::class, 'namaAuditee', 'nik');
    }

}
