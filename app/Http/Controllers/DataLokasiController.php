<?php

namespace App\Http\Controllers;

use App\Models\DataLokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class DataLokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $lokasi = DataLokasi::get();
            return DataTables::of($lokasi)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' . route('data-lokasi.edit', $row->id) . '" class="edit btn btn-warning text-light btn-sm">Ubah</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('lokasi.data-lokasi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lokasi.tambah-lokasi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required',
            'keterangan' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        DataLokasi::create([
            'id_user' => Auth::user()->id,
            'nama_lokasi' => $request->nama_lokasi,
            'keterangan' => $request->keterangan,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return redirect()->route('data-lokasi.index')->with('success', 'Data Lokasi Berhasil Ditambahkan!!!');
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
        $lokasi = DataLokasi::find($id);

        return view('lokasi.edit-lokasi', compact('lokasi'));
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
        $lokasi = DataLokasi::find($id);

        $lokasi->update([
            'id_user' => Auth::user()->id,
            'nama_lokasi' => $request->nama_lokasi,
            'keterangan' => $request->keterangan,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return redirect()->route('data-lokasi.index')->with('success', 'Data Lokasi Berhasil Diubah!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $lokasi = DataLokasi::find($id);
            $lokasi->delete();

            return response()->json(['success' => 'Data berhasil dihapus'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}
