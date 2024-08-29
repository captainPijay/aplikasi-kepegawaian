<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataInstansi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(User::class, 'data_instansi_id');
    }
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'data_instansi_id');
    }
}
