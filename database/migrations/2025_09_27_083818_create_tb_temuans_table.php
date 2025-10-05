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
        Schema::create('tb_temuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_hasilpengamatan');
            $table->string('nik');
            $table->text('deskripsi');
            $table->string('krisis');
            $table->string('lokasi');
            $table->string('prosedure');
            $table->string('elemen');
            $table->date('tanggal');
            $table->string('id_cabang');
            $table->enum('status', ['draft', 'proses', 'revisi', 'selesai','closed','ditolak'])->default('draft');

            $table->unsignedBigInteger('current_owner_id'); // siapa yang pegang saat ini (default lead auditor)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_temuan');
    }
};
