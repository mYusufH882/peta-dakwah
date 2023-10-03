<?php

namespace App\Http\Controllers;

use App\Models\DataLokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewMapController extends Controller
{
    public function index()
    {
        return view('view-map');
    }

    public function getMarkLokasi()
    {
        $lokasi = DataLokasi::where('id_user', Auth::user()->id)->get()->toArray();
        return response()->json($lokasi);
    }
}
