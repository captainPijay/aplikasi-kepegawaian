<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanKerjaInduk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function satuanKerja()
    {
        return $this->hasMany(SatuanKerja::class);
    }
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
