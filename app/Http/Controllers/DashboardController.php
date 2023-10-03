<?php

namespace App\Http\Controllers;

use App\Models\DataLokasi;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $lokasi = DataLokasi::get();
            return DataTables::of($lokasi)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="" class="edit btn btn-info btn-sm">Lihat</a>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('dashboard');
    }
}
