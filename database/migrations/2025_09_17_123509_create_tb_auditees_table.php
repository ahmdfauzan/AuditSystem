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
        Schema::create('tb_auditee', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nik')->unique();
            $table->string('dept')->nullable();
            $table->string('jabatan')->nullable();
            $table->unsignedBigInteger('id_cabang')->nullable();
            $table->timestamps();

            // Tambahan
            $table->string('fotoTtd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_auditee');
    }
};
