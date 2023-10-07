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
                ->addColumn('tipe', function ($row) {
                    $tipe = ucfirst($row->tipe_anggota);
                    return $tipe;
                })
                ->addColumn('foto', function ($row) {
                    $image = ($row->user->avatar != null) ? "<img src=" . asset('foto/' . $row->user->avatar) . " style='width:160px;'>" : "Belum tersedia!!!";
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
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ]);

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'image|mimes:jpg,png,jpeg|max:2048'
            ]);

            $namaGambar = $request->file('avatar')->getClientOriginalName();
            $request->avatar->move(public_path('foto'), $namaGambar);
        }

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'name' => strtolower(trim($request->nama_lengkap)),
            'email' => $request->email,
            'avatar' => ($request->hasFile('avatar')) ? $namaGambar : '',
            'password' => bcrypt('12345678')
        ]);

        UserDetail::create([
            'id_user' => $user->id,
            'id_lokasi' => $request->lokasi,
            'tipe_anggota' => $request->tipe_anggota,
            'jabatan_anggota' => $request->jabatan_anggota,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'no_telp' => $request->no_telp,
            'status' => $request->status,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'npa' => $request->npa,
            'profesi' => $request->profesi,
            'pendaftaran_anggota' => $request->pendaftaran_anggota,
            'masa_aktif_kta' => $request->masa_aktif_kta,
            'pimpinan_wilayah' => $request->pimpinan_wilayah,
            'pimpinan_daerah' => $request->pimpinan_daerah,
            'pimpinan_cabang' => $request->pimpinan_cabang,
            'pimpinan_jamaah' => $request->pimpinan_jamaah
        ]);

        return redirect()->route('data-anggota.index')->with('success', 'Data Berhasil Ditambahkan !!!');
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
        $anggota = UserDetail::find($id);
        $lokasi = DataLokasi::get();

        return view('anggota.edit-anggota', compact('anggota', 'lokasi'));
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
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ]);

        $user = User::find($id);
        $anggota = UserDetail::where('id_user', $id)->first();

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'image|mimes:jpg,png,jpeg|max:2048'
            ]);

            if ($user->avatar) {
                unlink(public_path('foto') . '/' . $user->avatar);
            }

            $namaGambar = $request->file('avatar')->getClientOriginalName();
            $request->avatar->move(public_path('foto'), $namaGambar);
        }

        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'name' => strtolower(trim($request->nama_lengkap)),
            'email' => $request->email,
            'avatar' => ($request->hasFile('avatar')) ? $namaGambar : '',
            'password' => bcrypt('12345678')
        ]);

        $anggota->update([
            'id_user' => $user->id,
            'id_lokasi' => $request->lokasi,
            'tipe_anggota' => $request->tipe_anggota,
            'jabatan_anggota' => $request->jabatan_anggota,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'no_telp' => $request->no_telp,
            'status' => $request->status,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'npa' => $request->npa,
            'profesi' => $request->profesi,
            'pendaftaran_anggota' => $request->pendaftaran_anggota,
            'masa_aktif_kta' => $request->masa_aktif_kta,
            'pimpinan_wilayah' => $request->pimpinan_wilayah,
            'pimpinan_daerah' => $request->pimpinan_daerah,
            'pimpinan_cabang' => $request->pimpinan_cabang,
            'pimpinan_jamaah' => $request->pimpinan_jamaah
        ]);

        return redirect()->route('data-anggota.index')->with('success', 'Data Berhasil Diubah !!!');
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
            $anggota = UserDetail::find($id);
            $user = User::where('id', $anggota->id_user)->first();

            unlink(public_path('foto') . '/' . $user->avatar);
            $user->delete();
            $anggota->delete();

            return response()->json(['success' => 'Data berhasil dihapus'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 'Terjadi kesalahan saat menghapus data: ' . $th], 500);
        }
    }
}
