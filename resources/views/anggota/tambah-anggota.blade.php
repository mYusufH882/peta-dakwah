@extends('layouts.base')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Form Tambah Data Anggota</h1>
        </div>
        <div class="row">
            <div class="col-md col-xl">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">Input Data Anggota</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('data-anggota.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap')
                                            is-invalid
                                        @enderror">
                                        @error('nama_lengkap')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="avatar">Foto Profil</label>
                                        <input type="file" name="avatar" id="avatar" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control @error('alamat')
                                            is-invalid
                                        @enderror"></textarea>
                                        @error('alamat')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="rt">RT</label>
                                                <input type="text" name="rt" id="rt" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="rw">RW</label>
                                                <input type="text" name="rw" id="rw" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lokasi">Lokasi Pimpinan Jama'ah</label>
                                        <select name="lokasi" id="lokasi" class="form-control">
                                            @foreach ($lokasi as $item)
                                            <option value="{{$item->id}}">{{$item->nama_lokasi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" name="latitude" id="latitude" class="form-control" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="peta" style="height: 650px;" class="mb-3"></div>
                                    <script type="text/javascript">
                                        var map = L.map('peta');
                                        map.setView([{{env('LATITUDE')}}, {{env('LONGITUDE')}}], 15);
                                        map.locate({setView: true, maxZoom: 20})
                                        
                                        //GMaps
                                        L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                            maxZoom: 20,
                                            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                                        }).addTo(map);
    
                                        //Open Street Map
                                        // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                                        // }).addTo(map);
    
                                        //Event Click
                                        map.on('click', function (e) {
                                            L.popup().setLatLng(e.latlng)
                                                .setContent("Titik Koordinat : " + e.latlng.toString())
                                                .openOn(map);
    
                                            document.getElementById('latitude').value = e.latlng.lat;
                                            document.getElementById('longitude').value = e.latlng.lng;
                                        });
    
                                        var myLayer = L.geoJSON().addTo(map);
                                        myLayer.addData(geojson);
                                    </script>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="npa">NPA</label>
                                    <input type="text" name="npa" id="npa" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="profesi">Profesi</label>
                                    <input type="text" name="profesi" id="profesi" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_telp">Nomor Telepon</label>
                                    <input type="text" name="no_telp" id="no_telp" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="menikah">Menikah</option>
                                        <option value="belum_menikah">Belum Menikah</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tipe_anggota">Tipe Anggota</label>
                                    <select name="tipe_anggota" id="tipe_anggota" class="form-control">
                                        <option value="">Silahkan pilih</option>
                                        <option value="persis">Persis</option>
                                        <option value="persistri">Persistri</option>
                                        <option value="pemuda">Pemuda</option>
                                        <option value="pemudi">Pemudi</option>
                                        <option value="simpatisan">Simpatisan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="jabatan">Jabatan Anggota</label>
                                    <input type="text" name="jabatan_anggota" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="pendaftaran_anggota">Pendaftaran Anggota</label>
                                    <input type="date" name="pendaftaran_anggota" id="pendaftaran_anggota"
                                        class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="masa_aktif_kta">Masa Aktif KTA</label>
                                    <input type="date" name="masa_aktif_kta" id="masa_aktif_kta" class="form-control">
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="wilayah">Pimpinan Wilayah</label>
                                    <select name="wilayah" id="wilayah" class="form-control"></select>
                                </div>
                                <div class="col-md-6">
                                    <label for="daerah">Pimpinan Daerah</label>
                                    <select name="daerah" id="daerah" class="form-control"></select>
                                </div>
                                <div class="col-md-6">
                                    <label for="cabang">Pimpinan Cabang</label>
                                    <select name="cabang" id="cabang" class="form-control"></select>
                                </div>
                                <div class="col-md-6">
                                    <label for="jamaah">Pimpinan Jama'ah</label>
                                    <select name="jamaah" id="jamaah" class="form-control"></select>
                                </div>
                            </div> --}}

                            <a href="{{route('data-anggota.index')}}" class="btn btn-sm btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection