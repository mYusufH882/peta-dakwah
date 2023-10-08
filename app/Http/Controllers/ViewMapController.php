<?php

namespace App\Http\Controllers;

use App\Models\DataLokasi;
use App\Models\User;
use App\Models\UserDetail;

class ViewMapController extends Controller
{
    public function index()
    {
        $anggota = new UserDetail();
        $lokasi = new DataLokasi();
        $data = [
            'jmlPersis' => $anggota->jumlahOrang('persis'),
            'jmlPersistri' => $anggota->jumlahOrang('persistri'),
            'jmlPemuda' => $anggota->jumlahOrang('pemuda'),
            'jmlPemudi' => $anggota->jumlahOrang('pemudi'),
            'jmlSimpatisan' => $anggota->jumlahOrang('simpatisan'),
            'jmlLokasi' => $lokasi->get()->count()
        ];
        return view('view-map', compact('data'));
    }

    // public function getMarkAnggota()
    // {
    //     $anggota = UserDetail::with('user')->get();

    //     return response()->json($anggota);
    // }

    public function getMarker()
    {
        $lokasi = DataLokasi::all();
        $anggota = UserDetail::with('user')->get();

        $data = [
            'lokasi' => $lokasi,
            'anggota' => $anggota
        ];

        $json = json_encode($data);

        return response()->json($json);
    }
}
