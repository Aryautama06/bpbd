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
        Schema::create('nilai_alternatifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alternatif_id');
            $table->unsignedBigInteger('kriteria_id');
            $table->decimal('nilai', 10, 4);
            $table->timestamps();

            $table->foreign('alternatif_id')
                  ->references('id')
                  ->on('alternatifs')
                  ->onDelete('cascade');
            
            $table->foreign('kriteria_id')
                  ->references('id')
                  ->on('kriterias')
                  ->onDelete('cascade');

            $table->unique(['alternatif_id', 'kriteria_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_alternatifs');
    }
};
