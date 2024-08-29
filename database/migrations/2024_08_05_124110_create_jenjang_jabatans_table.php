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
        Schema::create('jenjang_jabatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id');
            $table->string('jenjang_jabatan_name');
            $table->enum('jabatan_pensiun', ['Kadis', 'Sekretaris', 'Kasubag', 'Ahli Utama', 'Ahli Madya', 'Ahli Muda', 'Ahli Pertama', 'Penyelia', 'Terampil', 'Administrasi']);
            $table->date('tanggal_pensiun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenjang_jabatans');
    }
};
