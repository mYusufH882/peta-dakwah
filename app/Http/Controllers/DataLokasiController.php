<?php

namespace App\Http\Controllers;

use App\Models\DataLokasi;
use Illuminate\Http\Request;
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
                ->addColumn('gambar', function ($row) {
                    $image = ($row->gambar_lokasi) ? "<img src=" . asset('lokasi/' . $row->gambar_lokasi) . " style='width:160px;'>" : "Belum tersedia!!!";
                    return $image;
                })
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' . route('data-lokasi.edit', $row->id) . '" class="edit btn btn-warning text-light btn-sm">Ubah</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['gambar', 'aksi'])
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
        $lokasi = new DataLokasi();
        $request->validate([
            'nama_lokasi' => 'required',
            'keterangan' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->keterangan = $request->keterangan;
        $lokasi->alamat = $request->alamat;
        $lokasi->latitude = $request->latitude;
        $lokasi->longitude = $request->longitude;

        if ($request->hasFile('gambar_lokasi')) {
            $request->validate([
                'gambar_lokasi' => 'image|mimes:jpg,png,jpeg|max:2048'
            ]);

            $namaGambar = $request->file('gambar_lokasi')->getClientOriginalName();
            $request->gambar_lokasi->move(public_path('lokasi'), $namaGambar);
        }

        $lokasi->gambar_lokasi = ($request->hasFile('gambar_lokasi')) ? $namaGambar : "";
        $lokasi->save();

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

        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->keterangan = $request->keterangan;
        $lokasi->alamat = $request->alamat;
        $lokasi->latitude = $request->latitude;
        $lokasi->longitude = $request->longitude;

        if ($request->hasFile('gambar_lokasi')) {
            $request->validate([
                'gambar_lokasi' => 'image|mimes:jpg,png,jpeg|max:2048'
            ]);

            if ($lokasi->gambar_lokasi) {
                unlink(public_path('lokasi') . '/' . $lokasi->gambar_lokasi);
            }

            $namaGambar = $request->file('gambar_lokasi')->getClientOriginalName();
            $request->gambar_lokasi->move(public_path('lokasi'), $namaGambar);
        }

        $lokasi->gambar_lokasi = ($request->hasFile('gambar_lokasi')) ? $namaGambar : "";
        $lokasi->save();

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
            unlink(public_path('lokasi') . '/' . $lokasi->gambar_lokasi);
            $lokasi->delete();

            return response()->json(['success' => 'Data berhasil dihapus'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}
