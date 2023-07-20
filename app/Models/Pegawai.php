<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'nip', 'opd_id', 'nama', 'golongan'
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function spj()
    {
        return $this->hasMany(Spj::class);
    }
}
