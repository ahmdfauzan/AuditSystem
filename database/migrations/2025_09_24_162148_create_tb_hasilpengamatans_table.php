<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Tb_hasilpengamatan', function (Blueprint $table) {
            $table->id();
            $table->string('namaAudit');
            $table->date('tanggal');
            $table->string('kategori');
            $table->longText('catatan');
            $table->string('id_cabang');
            $table->string('namaAuditor');
            $table->string('lokasi');
            $table->string('namaAuditee');
            $table->enum('status_final', ['draft','proses','pending', 'approved', 'rejected'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tb_hasilpengamatan');
    }
};
