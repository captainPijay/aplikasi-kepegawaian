<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'SuperAdmin',
            'username' => 'superAdmin',
            'password' => bcrypt(1),
            'role' => 'Super Admin'
        ]);
        \App\Models\Kpkn::create([
            'name' => 'Kpkn Tes',
        ]);
        \App\Models\DataInstansi::create([
            'name' => 'Data Instansi',
        ]);
        // \App\Models\UnitOrganisasi::create([
        //     'name' => 'Osis',
        // ]);
        // \App\Models\DataInstansi::create([
        //     'name' => 'Kominfo',
        // ]);
        \App\Models\WorkLocation::create([
            'name' => 'Work Location',
        ]);
        // \App\Models\SatuanKerjaInduk::create([
        //     'name' => 'Dinsos',
        // ]);
        // \App\Models\SatuanKerja::create([
        //     'satuan_kerja_induk_id' => '1',
        //     'name' => 'Panti Sosial',
        // ]);
        // \App\Models\Pegawai::create([
        //     'name' => 'Pijay',
        //     'gelar_depan' => 'Haji',
        //     'image' => 'gambar1',
        //     'gelar_belakang' => 'S.Kom',
        //     'place_of_birth' => 'jambi',
        //     'date_of_birth' => now(),
        //     'gender' => 'Laki-Laki',
        //     'religion' => 'islam',
        //     'married_type' => 'Menikah',
        //     'nik_number' => '0020258049',
        //     'phone_number' => '082180864290',
        //     'email' => 'muhammadzahran02@gmail.com',
        //     'email_gov' => 'kominfo@gmail.com',
        //     'address' => 'Mayang Mangurai',
        //     'npwp_number' => '12345',
        //     'bpjs_number' => '12345678',
        //     'username' => 'pijay0205',
        //     'old_username' => 'pijay0201',
        //     'employee_type' => 'Pegawai Tetap',
        //     'cpns_type' => 'PNS Kota',
        //     'virtual_asn_card' => '12345678',
        //     'skck_number' => 'skck123',
        //     'sk_cpns_date' => now(),
        //     'tmt_cpns' => now(),
        //     'pns_sk_number' => 'sk-nomor-123',
        //     'sk_pns_date' => now(),
        //     'tmt_pns' => now(),
        //     'golongan_awal' => 'III-C',
        //     'golongan_akhir' => 'IV-E',
        //     'tmt_golongan' => now(),
        //     'mk_year' => '2024',
        //     'mk_month' => '05',
        //     'data_instansi_id' => '1',
        //     'kpkn_id' => '1',
        //     'unor_id' => '1',
        //     'work_location_id' => '1',
        //     'satuan_kerja_induk_id' => '1',
        //     'satuan_kerja_id' => '1',
        //     'password' => bcrypt('12345'),
        // ]);
    }
}
