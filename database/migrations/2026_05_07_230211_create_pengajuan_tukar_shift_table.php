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
        Schema::create('pengajuan_tukar_shift', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anggota_pengaju_id')
                ->constrained('anggota_jadwal')
                ->cascadeOnDelete();

            $table->foreignId('anggota_tujuan_id')
                ->constrained('anggota_jadwal')
                ->cascadeOnDelete();

            $table->enum('tipe_pengajuan', [
                'tukar_leader',
                'tukar_operator'
            ]);

            $table->text('alasan');

            $table->enum('status', [
                'pending',
                'disetujui',
                'ditolak',
                'dibatalkan'
            ])->default('pending');

            $table->foreignId('disetujui_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->dateTime('disetujui_pada')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_tukar_shift');
    }
};
