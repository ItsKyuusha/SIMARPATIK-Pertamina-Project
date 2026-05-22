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
        Schema::create('riwayat_shift', function (Blueprint $table) {
            $table->id();

            $table->foreignId('karyawan_id')
                ->constrained('karyawan')
                ->cascadeOnDelete();

            $table->foreignId('jadwal_lama_id')
                ->nullable()
                ->constrained('jadwal')
                ->nullOnDelete();

            $table->foreignId('jadwal_baru_id')
                ->nullable()
                ->constrained('jadwal')
                ->nullOnDelete();

            $table->foreignId('diubah_oleh')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('tipe_perubahan', [
                'buat',
                'ubah',
                'tukar',
                'hapus'
            ]);

            $table->text('catatan')->nullable();

            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_shift');
    }
};
