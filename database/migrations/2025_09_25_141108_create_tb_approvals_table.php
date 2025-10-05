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
        Schema::create('tb_approval', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_roomaudit');
            $table->unsignedBigInteger('id_hasilpengamatan');
            $table->unsignedBigInteger('id_temuan');
            $table->enum('role', ['leadauditor', 'depthead', 'mr']);
            $table->unsignedBigInteger('user_id'); // siapa approver
            $table->enum('status', ['pending', 'approved', 'rejected', 'skipped'])->default('pending');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_approval');
    }
};
