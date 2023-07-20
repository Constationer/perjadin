<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spj extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_st', 'no_sppd', 'pegawai_id', 'tanggal_pelaksanaan', 'tanggal_selesai', 'tujuan', 'uang_harian', 'kendaraan', 'tiket', 'hotel', 'uang_hotel'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
