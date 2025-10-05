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
        Schema::create('tb_roomAudit', function (Blueprint $table) {
            $table->id();
            $table->string('namaAudit')->nullable();
            $table->date('tglMulai')->nullable();
            $table->date('tglSelesai')->nullable();
            $table->string('kodeRoom')->nullable();
            $table->string('sandiRoom')->nullable();
            $table->string('id_cabang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_roomAudit');
    }
};
