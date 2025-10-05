<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_cabang extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'data_cabang';
    protected $fillable = ['cabang','divisi', 'kode_cabang'];
}
