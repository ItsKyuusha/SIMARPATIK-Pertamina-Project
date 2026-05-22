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
        Schema::create('approval_pengajuan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_id')
                ->constrained('pengajuan_tukar_shift')
                ->cascadeOnDelete();

            $table->foreignId('approver_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('status_approval', [
                'pending',
                'disetujui',
                'ditolak'
            ])->default('pending');

            $table->text('catatan')->nullable();

            $table->dateTime('approved_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_pengajuan');
    }
};
