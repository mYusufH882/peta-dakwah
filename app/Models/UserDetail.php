<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_detail';

    protected $fillable = [
        'id_user',
        'id_lokasi',
        'tipe_anggota',
        'jabatan_anggota',
        'rt',
        'rw',
        'no_telp',
        'status',
        'alamat',
        'latitude',
        'longitude',
        'npa',
        'profesi',
        'pendaftaran_anggota',
        'masa_aktif_kta',
        'pimpinan_wilayah',
        'pimpinan_daerah',
        'pimpinan_cabang',
        'pimpinan_jamaah'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function lokasi()
    {
        return $this->belongsTo(DataLokasi::class, 'id_lokasi', 'id');
    }
}
