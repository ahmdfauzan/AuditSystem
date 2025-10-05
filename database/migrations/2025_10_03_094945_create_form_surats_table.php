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
        Schema::create('form_surat', function (Blueprint $table) {
            $table->id();
            $table->string('kodeForm')->nullable();
            $table->string('noTerbitan')->nullable();
            $table->string('tglEfektif')->nullable();
            $table->string('id_cabang')->nullable();
            $table->string('id_nik')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_surat');
    }
};
