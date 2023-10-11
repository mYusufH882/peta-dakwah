<?php

namespace App\Http\Controllers;

use App\Models\DataLokasi;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $anggota = UserDetail::get();
        if ($request->ajax()) {
            return DataTables::of($anggota)
                ->addIndexColumn()
                ->addColumn('nama_lengkap', function ($row) {
                    $nml = $row->user->nama_lengkap;
                    return $nml;
                })
                ->addColumn('tipe', function ($row) {
                    $tipe = ucfirst($row->tipe_anggota);
                    return $tipe;
                })
                ->addColumn('titik_lokasi', function ($row) {
                    $tag = null;
                    if ($row->latitude && $row->longitude) {
                        $tag = $row->latitude . "\n" . $row->longitude;
                    } else {
                        $tag = "Titik Lokasi Masih Kosong!!!";
                    }

                    return $tag;
                })
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' . route('data-anggota.edit', $row->id) . '" class="edit text-light btn btn-info btn-sm">Lihat</a>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        $data = [
            'jmlPersis' => UserDetail::jumlahOrang('persis'),
            'jmlPersistri' => UserDetail::jumlahOrang('persistri'),
            'jmlPemuda' => UserDetail::jumlahOrang('pemuda'),
            'jmlPemudi' => UserDetail::jumlahOrang('pemudi'),
            'jmlSimpatisan' => UserDetail::jumlahOrang('simpatisan'),
        ];

        return view('dashboard', compact('data'));
    }
}
