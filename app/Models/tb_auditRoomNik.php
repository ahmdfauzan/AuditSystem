<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_auditRoomNik extends Model
{
    use HasFactory;
    protected $table = 'tb_audit_roomnik'; // nama tabel
    protected $fillable = ['room_audit_id', 'nik']; // field yang bisa diisi
}
