<?php

namespace App\Http\Controllers;

use App\Models\DataLokasi;
use Illuminate\Http\Request;

class ViewMapController extends Controller
{
    public function index()
    {
        return view('view-map');
    }

    public function getMarkLokasi()
    {
        $lokasi = DataLokasi::all();
        return response()->json($lokasi);
    }
}
