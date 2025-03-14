<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hasil_perhitungan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_perhitungan');
            $table->string('nama_perhitungan');
            $table->text('deskripsi')->nullable();
            $table->json('bobot_ahp');
            $table->json('hasil_topsis');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_perhitungan');
    }
};