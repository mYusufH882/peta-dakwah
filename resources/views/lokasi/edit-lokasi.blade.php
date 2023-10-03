@extends('layouts.base')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Ubah Lokasi {{ucfirst($lokasi->nama_lokasi)}}</h1>
        </div>
        <div class="row">
            <div class="col-md col-xl">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">Ubah Data Lokasi</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('data-lokasi.update', $lokasi->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div id="peta" style="height: 350px;" class="mb-3"></div>
                            <script type="text/javascript">
                                var map = L.map('peta');
                                var lat = '{{$lokasi->latitude}}';
                                var lng = '{{$lokasi->longitude}}';

                                map.setView([lat, lng], 20);
                                map.locate({setView: true, maxZoom: 20})
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

                            <div class="mb-3">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control"
                                    value="{{$lokasi->latitude}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control"
                                    value="{{$lokasi->longitude}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nama_lokasi">Nama Lokasi</label>
                                <input type="text" name="nama_lokasi" id="nama_lokasi" class="form-control"
                                    value="{{$lokasi->nama_lokasi}}">
                            </div>
                            <div class="mb-3">
                                <label for="gambar">Gambar Lokasi</label>
                                <input type="file" name="gambar_lokasi" id="gambar_lokasi" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control">{{$lokasi->alamat}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan"
                                    class="form-control">{{$lokasi->keterangan}}</textarea>
                            </div>
                            <a href="{{route('data-lokasi.index')}}" class="btn btn-sm btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-sm btn-warning text-light">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection