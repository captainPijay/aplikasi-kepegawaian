<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pendidikan()
    {
        return $this->hasOne(Pendidikan::class);
    }
    public function suamiIstri()
    {
        return $this->hasMany(SuamiIstri::class);
    }
    public function anak()
    {
        return $this->hasMany(SuamiIstri::class);
    }
    public function cuti()
    {
        return $this->hasMany(Cuti::class);
    }
    public function jabatan()
    {
        return $this->hasOne(Jabatan::class);
    }
    public function jenjangJabatan()
    {
        return $this->hasOne(JenjangJabatan::class);
    }
    public function kenaikanGaji()
    {
        return $this->hasMany(KenaikanGaji::class);
    }
    public function tunjangan()
    {
        return $this->hasMany(Tunjangan::class);
    }
    public function datainstansi()
    {
        return $this->belongsTo(DataInstansi::class, 'data_instansi_id');
    }
    public function kpkn()
    {
        return $this->belongsTo(Kpkn::class, 'kpkn_id');
    }
    public function worklocation()
    {
        return $this->belongsTo(WorkLocation::class, 'work_location_id');
    }
    public function satuankerjainduk()
    {
        return $this->belongsTo(SatuanKerjaInduk::class, 'satuan_kerja_induk_id');
    }
    public function satuankerja()
    {
        return $this->belongsTo(SatuanKerja::class, 'satuan_kerja_id');
    }
}
