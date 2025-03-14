<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kriteria')->unique();
            $table->string('nama_kriteria');
            $table->decimal('bobot', 10, 4)->default(0);
            $table->enum('jenis', ['benefit', 'cost']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kriterias');
    }
};
