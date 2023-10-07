@extends('layouts.base')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Ubah Data Anggota</h1>
        </div>
        <div class="row">
            <div class="col-md col-xl">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">Ubah Data Anggota</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('data-anggota.update', $anggota->id_user)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                                            value="{{$anggota->user->nama_lengkap}}" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        @if ($anggota->user->avatar)
                                        <div class="mb-3">
                                            <img src="{{asset('foto/'.$anggota->user->avatar)}}" alt="Foto Profil"
                                                style="height: 150px;">
                                        </div>
                                        @else
                                        <span class="text-warning">Foto tidak tersedia!!! Tambahkan foto
                                            profil.</span><br>
                                        @endif
                                        <label for="avatar">Foto Profil</label>
                                        <input type="file" name="avatar" id="avatar" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{$anggota->user->email}}"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat"
                                            class="form-control">{{$anggota->alamat}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="rt">RT</label>
                                                <input type="text" name="rt" id="rt" value="{{$anggota->rt}}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="rw">RW</label>
                                                <input type="text" name="rw" id="rw" value="{{$anggota->rw}}"
                                                    class="form-control">
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
                                        <input type="text" name="latitude" id="latitude" value="{{$anggota->latitude}}"
                                            class="form-control" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" name="longitude" id="longitude"
                                            value="{{$anggota->longitude}}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="peta" style="height: 650px;" class="mb-3"></div>
                                    <script type="text/javascript">
                                        var map = L.map('peta');
                                        var lat = '{{($anggota->latitude != 0) ? $anggota->latitude : env('LATITUDE')}}';
                                        var lng = '{{($anggota->longitude != 0) ? $anggota->longitude : env('LONGITUDE')}}';
console.log(lat)
                                        map.setView([lat, lng], 16);
                                        map.locate({setView: true, maxZoom: 20});
                                        L.marker([lat, lng]).addTo(map);
                                        
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
                                    <label for="no_telp">Nomor Telepon</label>
                                    <input type="text" name="no_telp" id="no_telp" value="{{$anggota->no_telp}}"
                                        class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="menikah" {{$anggota->status == "menikah" ? 'selected' :
                                            ''}}>Menikah</option>
                                        <option value="belum menikah" {{$anggota->status == "belum menikah" ? 'selected'
                                            : ''}}>Belum Menikah</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tipe_anggota">Tipe Anggota</label>
                                    <select name="tipe_anggota" id="tipe_anggota" class="form-control">
                                        <option value="">Silahkan pilih</option>
                                        <option value="persis" {{$anggota->tipe_anggota == "persis" ? 'selected' :
                                            ''}}>Persis
                                        </option>
                                        <option value="persistri" {{$anggota->tipe_anggota == "persistri" ? 'selected' :
                                            ''}}>Persistri</option>
                                        <option value="pemuda" {{$anggota->tipe_anggota == "pemuda" ? 'selected' :
                                            ''}}>Pemuda
                                        </option>
                                        <option value="pemudi" {{$anggota->tipe_anggota == "pemudi" ? 'selected' :
                                            ''}}>Pemudi
                                        </option>
                                        <option value="simpatisan" {{$anggota->tipe_anggota == "simpatisan" ? 'selected'
                                            :
                                            ''}}>Simpatisan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="jabatan">Jabatan Anggota</label>
                                    <input type="text" name="jabatan_anggota" value="{{$anggota->jabatan_anggota}}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="pendaftaran_anggota">Pendaftaran Anggota</label>
                                    <input type="date" name="pendaftaran_anggota"
                                        value="{{$anggota->pendaftaran_anggota}}" id="pendaftaran_anggota"
                                        class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="masa_aktif_kta">Masa Aktif KTA</label>
                                    <input type="date" name="masa_aktif_kta" value="{{$anggota->masa_aktif_kta}}"
                                        id="masa_aktif_kta" class="form-control">
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
                            <button type="submit" class="btn btn-sm btn-warning text-white">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection