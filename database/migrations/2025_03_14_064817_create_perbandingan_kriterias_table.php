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
        Schema::create('perbandingan_kriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kriteria1_id');
            $table->unsignedBigInteger('kriteria2_id');
            $table->decimal('nilai', 10, 4);
            $table->timestamps();

            $table->foreign('kriteria1_id')
                  ->references('id')
                  ->on('kriterias')
                  ->onDelete('cascade');
            
            $table->foreign('kriteria2_id')
                  ->references('id')
                  ->on('kriterias')
                  ->onDelete('cascade');

            $table->unique(['kriteria1_id', 'kriteria2_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbandingan_kriterias');
    }
};
