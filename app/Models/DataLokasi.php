<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLokasi extends Model
{
    use HasFactory;

    protected $table = "data_lokasi";
    protected $fillable = [
        'nama_lokasi', 'pimpinan_jamaah', 'diresmikan', 'keterangan', 'alamat', 'latitude', 'longitude', 'gambar_lokasi'
    ];
}
