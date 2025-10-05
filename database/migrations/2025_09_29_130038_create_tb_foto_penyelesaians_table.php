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
        Schema::create('tb_foto_penyelesaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penyelesaian_id');
            $table->string('foto'); // nama file foto
            $table->timestamps();

            $table->foreign('penyelesaian_id')
            ->references('id')->on('tb_penyelesaian')
            ->onDelete('cascade'); // jika temuan dihapus, fotonya ikut terhapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_foto_penyelesaian');
    }
};
