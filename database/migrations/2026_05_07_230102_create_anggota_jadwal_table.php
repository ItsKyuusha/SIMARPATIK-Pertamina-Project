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
        Schema::create('anggota_jadwal', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jadwal_id')
                ->constrained('jadwal')
                ->cascadeOnDelete();

            $table->foreignId('karyawan_id')
                ->constrained('karyawan')
                ->cascadeOnDelete();

            $table->enum('tipe_role', [
                'leader',
                'operator'
            ]);

            $table->enum('status_kehadiran', [
                'pending',
                'hadir',
                'terlambat',
                'tidak_hadir',
                'izin'
            ])->default('pending');

            $table->text('catatan')->nullable();

            $table->timestamps();

            $table->unique([
                'jadwal_id',
                'karyawan_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_jadwal');
    }
};
