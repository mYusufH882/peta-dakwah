<?php

namespace App\Http\Controllers;

use App\Models\DataLokasi;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $anggota = UserDetail::get();
            return DataTables::of($anggota)
                ->addIndexColumn()
                ->addColumn('foto', function ($row) {
                    $image = ($row->user->avatar) ? "<img src=" . asset('user/' . $row->user->avatar) . " style='width:160px;'>" : "Belum tersedia!!!";
                    return $image;
                })
                ->addColumn('nama', function ($row) {
                    return $row->user->nama_lengkap;
                })
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' . route('data-anggota.edit', $row->id) . '" class="edit btn btn-warning text-light btn-sm">Ubah</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['foto', 'nama', 'aksi'])
                ->make(true);
        }

        return view('anggota.data-anggota');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lokasi = DataLokasi::get();

        return view('anggota.tambah-anggota', compact('lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggota = User::find($id);
        return view('anggota.edit-anggota', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
