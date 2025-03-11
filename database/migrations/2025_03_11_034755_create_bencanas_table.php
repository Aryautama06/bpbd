<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bencanas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jenis_bencana');
            $table->string('lokasi');
            $table->string('kecamatan');
            $table->text('deskripsi');
            $table->text('dampak');
            $table->string('dampak_korban')->nullable();
            $table->string('dampak_kerusakan')->nullable();
            $table->enum('status', ['Proses', 'Selesai']);
            $table->decimal('kerugian', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bencanas');
    }
};