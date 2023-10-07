<?php

namespace App\Http\Controllers;

use App\Models\DataLokasi;
use App\Models\User;
use App\Models\UserDetail;

class ViewMapController extends Controller
{
    public function index()
    {
        return view('view-map');
    }

    public function getMarkLokasi()
    {
        // $lokasi = DataLokasi::all();
        $anggota = UserDetail::with('user')->get();

        return response()->json($anggota);
    }
}
