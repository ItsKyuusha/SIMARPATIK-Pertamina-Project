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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anggota_jadwal_id')
                ->constrained('anggota_jadwal')
                ->cascadeOnDelete();

            $table->dateTime('jam_masuk')->nullable();
            $table->dateTime('jam_keluar')->nullable();

            $table->enum('status', [
                'hadir',
                'terlambat',
                'tidak_hadir',
                'izin'
            ]);

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
