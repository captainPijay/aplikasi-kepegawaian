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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gelar_depan')->nullable()->default('Belum Ada Data');
            $table->longText('image')->nullable();
            $table->string('gelar_belakang')->nullable()->default('Belum Ada Data');
            $table->string('place_of_birth');
            $table->string('kepangkatan')->nullable()->default('Belum Ada Data');
            $table->date('date_of_birth');
            $table->enum('gender', ['Laki-Laki', 'Perempuan']);
            $table->enum('religion', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Kong Hu Cu', 'Lainnya']);
            $table->enum('married_type', ['Menikah', 'Belum Menikah']);
            $table->string('nik_number')->unique();
            $table->string('phone_number')->unique();
            $table->string('email')->unique();
            $table->string('address');
            $table->string('npwp_number')->unique()->nullable()->default('Belum Ada Data');
            $table->string('bpjs_number')->unique()->nullable()->default('Belum Ada Data');
            $table->string('username')->unique();
            $table->string('old_username')->nullable()->default('Belum Ada Data');
            $table->enum('employee_type', ['PPPK', 'PNS', 'Non ASN']);
            $table->enum('cpns_type', ['PNS Provinsi', 'PNS Kota'])->nullable();
            $table->string('virtual_asn_card')->unique()->nullable()->default('Belum Ada Data');
            $table->string('skck_number')->unique()->nullable()->default('Belum Ada Data');
            $table->date('sk_cpns_date')->nullable()->nullable()->default(null);
            $table->date('tmt_cpns')->nullable()->nullable()->default(null);
            $table->date('sk_pppk_date')->nullable()->nullable()->default(null);
            $table->date('sk_pppk_date_end')->nullable()->nullable()->default(null);
            $table->string('pns_sk_number')->unique()->nullable()->default('Belum Ada Data');
            $table->date('sk_pns_date')->nullable()->nullable()->default(null);
            $table->date('tmt_pns')->nullable()->default(null);
            $table->enum('golongan_awal', ['I-A', 'I-B', 'I-C', 'I-D', 'II-A', 'II-B', 'II-C', 'II-D', 'III-A', 'III-B', 'III-C', 'III-D', 'IV-A', 'IV-B', 'IV-C', 'IV-D', 'IV-E'])->nullable();
            $table->enum('golongan_akhir', ['I-A', 'I-B', 'I-C', 'I-D', 'II-A', 'II-B', 'II-C', 'II-D', 'III-A', 'III-B', 'III-C', 'III-D', 'IV-A', 'IV-B', 'IV-C', 'IV-D', 'IV-E'])->nullable();
            $table->enum('golongan_awal_pppk', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'])->nullable();
            $table->enum('golongan_akhir_pppk', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'])->nullable();
            $table->date('tmt_golongan')->nullable()->default(null);
            $table->string('mk_year')->nullable()->default('Belum Ada Data');
            $table->string('mk_month')->nullable()->default('Belum Ada Data');
            $table->foreignId('data_instansi_id');
            $table->foreignId('kpkn_id');
            $table->foreignId('work_location_id');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
