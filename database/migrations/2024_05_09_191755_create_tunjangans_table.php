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
        Schema::create('tunjangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id');
            $table->enum('anak', ['Iya', 'Tidak']);
            $table->enum('suami_atau_istri', ['Iya', 'Tidak']);
            $table->date('calculated_date');
            $table->longText('akta_perkawinan')->nullable();
            $table->longText('akta_lahir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tunjangans');
    }
};
