<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLokasi extends Model
{
    use HasFactory;

    protected $table = "data_lokasi";
    protected $fillable = [
        'id_user', 'nama_lokasi', 'keterangan', 'alamat', 'latitude', 'longitude'
    ];
}
