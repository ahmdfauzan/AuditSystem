<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_roomAudit extends Model
{
    public function niks()
    {
        return $this->hasMany(tb_auditRoomNik::class, 'room_audit_id');
    }

    use HasFactory;
    protected $guarded = [];
    protected $table = 'tb_roomAudit';
    protected $fillable = ['namaAudit','tglMulai', 'tglSelesai' ,'kodeRoom', 'sandiRoom', 'id_cabang'];

    public function hasilPengamatan()
    {
        return $this->hasMany(Tb_hasilpengamatan::class, 'namaAudit', 'id');
    }
}
