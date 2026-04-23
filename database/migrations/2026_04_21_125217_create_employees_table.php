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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->string('nip')->unique();

            // tambahan
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('notelp')->nullable();
            $table->string('jabatan')->nullable();
            $table->foreignId('jenis_kontrak_id')->nullable()->constrained('contracts')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
