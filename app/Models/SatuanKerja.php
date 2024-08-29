<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanKerja extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function satuanKerjaInduk()
    {
        return $this->belongsTo(SatuanKerjaInduk::class);
    }
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
