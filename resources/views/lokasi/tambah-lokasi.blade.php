@extends('layouts.base')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Form Tambah Data Lokasi</h1>
        </div>
        <div class="row">
            <div class="col-md col-xl">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">Input Data Lokasi</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('data-lokasi.store')}}" method="POST">
                            @csrf

                            <div id="peta" style="height: 350px;" class="mb-3"></div>
                            <script type="text/javascript">
                                var map = L.map('peta');
                                map.setView([{{env('LATITUDE')}}, {{env('LONGITUDE')}}], 16);
                                map.locate({setView: true, maxZoom: 16})
                                
                                //GMaps
                                L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                    maxZoom: 18,
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
                                <input type="text" name="latitude" id="latitude" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nama_lokasi">Nama Lokasi</label>
                                <input type="text" name="nama_lokasi" id="nama_lokasi" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                            </div>
                            <a href="{{route('data-lokasi.index')}}" class="btn btn-sm btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection