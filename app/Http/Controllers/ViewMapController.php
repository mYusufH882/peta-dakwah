<?php

namespace App\Http\Controllers;

use App\Models\DataLokasi;
use App\Models\User;

class ViewMapController extends Controller
{
    public function index()
    {
        return view('view-map');
    }

    public function getMarkLokasi()
    {
        $lokasi = DataLokasi::all();
        // $anggota = User::where('id', '!=', 1)->get()->toArray();

        return response()->json($lokasi);
    }
}
