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
        Schema::create('dana', function (Blueprint $table) {
            $table->id();
            $table->string('kode_anggaran')->unique();
            $table->string('nama_kegiatan');
            $table->enum('jenis_dana', ['APBD', 'APBN', 'Bantuan']);
            $table->decimal('jumlah', 15, 2);
            $table->date('tanggal_terima');
            $table->enum('status', ['Diterima', 'Digunakan', 'Sisa']);
            $table->text('keterangan')->nullable();
            $table->string('dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danas');
    }
};
