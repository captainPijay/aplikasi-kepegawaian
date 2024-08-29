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
        Schema::create('suami_istris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id');
            $table->string('suami_istri_name');
            $table->enum('latest_education', ['SD', 'SMP', 'SLTA', 'S1', 'S2', 'S3']);
            $table->string('job');
            $table->enum('status', ['Suami', 'Istri']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suami_istris');
    }
};
