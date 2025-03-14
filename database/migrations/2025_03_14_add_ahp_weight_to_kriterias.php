<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi.
     * Menambahkan kolom ahp_weight setelah kolom bobot
     */
    public function up()
    {
        Schema::table('kriterias', function (Blueprint $table) {
            // Menambah kolom ahp_weight dengan tipe decimal
            // - 10 digit total
            // - 4 digit di belakang koma
            // - boleh null
            // - posisi setelah kolom 'bobot'
            $table->decimal('ahp_weight', 10, 4)->nullable()->after('bobot');
        });
    }

    /**
     * Rollback migrasi.
     * Menghapus kolom ahp_weight jika migrasi dibatalkan
     */
    public function down()
    {
        Schema::table('kriterias', function (Blueprint $table) {
            $table->dropColumn('ahp_weight');
        });
    }
};