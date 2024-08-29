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
        Schema::create('pendidikans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id');
            $table->enum('jenjang', ['SD', 'SLTP', 'SLTA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3']);
            $table->string('school');
            $table->string('school_location');
            $table->string('name');
            $table->string('pass_date');
            $table->string('ijazah_number')->unique();
            $table->date('ijazah_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikans');
    }
};
