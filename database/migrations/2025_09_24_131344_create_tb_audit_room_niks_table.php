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
        Schema::create('tb_audit_roomnik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_audit_id')->constrained('tb_roomAudit')->onDelete('cascade');
            $table->string('nik'); // NIK siapa saja yang boleh masuk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_audit_roomnik');
    }
};
