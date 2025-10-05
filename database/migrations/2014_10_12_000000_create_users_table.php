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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Tambahan
            $table->string('level')->nullable(); // contoh: admin, user, auditor
            $table->string('nik')->unique(); // NIK unik
            $table->string('sistemManagement')->nullable();
            $table->string('dept')->nullable();
            $table->string('cabang')->nullable(); // nama cabang
            $table->string('kode_cabang')->nullable(); // kode cabang

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
