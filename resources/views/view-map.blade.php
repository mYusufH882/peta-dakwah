@extends('layouts.base')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Tampilan Peta (Wilayah Cibeureum)</h1>
        </div>
        <div class="row">
            <div class="col-md col-xl">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">Peta Wilayah PJ Cibeureum</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p>1. Anggota Persis <img src="/data/images/pins1.png" alt="tipe" style="width:20px;"> :
                                    {{$data['jmlPersis']}}<br>
                                    2. Anggota Persistri <img src="/data/images/pins2.png" alt="tipe"
                                        style="width:20px;"> : {{$data['jmlPersistri']}}</p>
                            </div>
                            <div class="col-md-4">
                                <p>3. Anggota Pemuda <img src="/data/images/pin1.png" alt="tipe" style="width:20px;"> :
                                    {{$data['jmlPemuda']}} Orang. <br>
                                    4. Anggota Pemudi <img src="/data/images/pin2.png" alt="tipe" style="width:20px;">
                                    : {{$data['jmlPemudi']}} Orang.</p>
                            </div>
                            <div class="col-md-4">
                                <p>5. Anggota Simpatisan <img src="/data/images/simpatisan.png" alt="tipe"
                                        style="width:20px;"> : {{$data['jmlSimpatisan']}} Orang. <br>
                                    6. Lokasi Masjid <img src="/data/images/flag.png" alt="tipe" style="width:20px;"> :
                                    {{$data['jmlLokasi']}} Lokasi.</p>
                            </div>
                        </div>
                        {{-- <div class="row mb-2">
                            <div class="col-md-3">
                                <a href="#" class="btn btn-block btn-sm btn-primary" id="printMap"><i
                                        data-feather="printer"></i>
                                    Print</a>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md">
                                <div id="map" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            $.ajax({
                                url: "/get-marker",
                                method: "GET",
                                dataType: "json",
                                success: function(data) {
                                    var map = L.map('map');
                                    map.setView([{{env('LATITUDE')}}, {{env('LONGITUDE')}}], 16);
            
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
                                    });

                                    var myLayer = L.geoJSON().addTo(map);
                                        myLayer.addData(geojson);

                                    //Info Anggota
                                    const allData = JSON.parse(data);
                                    allData['anggota'].forEach(function(item) {
                                        //Marker Members
                                        var tipe = item.tipe_anggota;
                                        var jabatan = item.jabatan_anggota;
                                        var gambar = (item.user.avatar) ? "<img src='foto/"+item.user.avatar+"' class='mx-auto d-block' style='width:150px;'>" : "<small>Gambar belum tersedia!!!</small>";
                                        var nama = "<p style='text-align: center;'>"+item.user.nama_lengkap+"</p>"+gambar+"<br>"+"<span style='text-align: center;'><b>"+tipe.toUpperCase()+"</b></span><br>"+"<span>"+jabatan+"</span>";
                                        
                                        var iconImage, iconSize;
                                        if(tipe == 'persis') {
                                            iconImage = 'pins1.png';
                                            iconSize = [35, 40];
                                        } else if(tipe == 'persistri') {
                                            iconImage = 'pins2.png';
                                            iconSize = [30, 40];
                                        } else if(tipe == 'pemuda') {
                                            iconImage = 'pin1.png';
                                            iconSize = [40, 50];
                                        } else if(tipe == 'pemudi') {
                                            iconImage = 'pin2.png';
                                            iconSize = [40, 50];
                                        } else if(tipe == 'simpatisan') {
                                            iconImage = 'simpatisan.png';
                                            iconSize = [30, 40];
                                        }
 
                                        var memberIcon = L.icon({
                                            iconUrl: '/data/images/'+iconImage,
                                            iconSize: iconSize, // size of the icon
                                        });

                                        var anggota = L.marker([item.latitude, item.longitude], {icon: memberIcon}).addTo(map)
                                            .bindPopup(nama);
                                        L.layerGroup([anggota]);
                                    });

                                    //Info Tempat
                                    allData['lokasi'].forEach(function(item) {
                                        //Marker Place
                                        var IconLocation = L.icon({
                                            iconUrl: '/data/images/flag.png',
                                            iconSize: [30, 40], // size of the icon
                                        });

                                        var gambar = (item.gambar_lokasi) ? "<img src='data/images/"+item.gambar_lokasi+"' class='mx-auto d-block' style='width:210px;'>" : "<small>Gambar belum tersedia!!!</small>";
                                        var tempat = L.marker([item.latitude, item.longitude], {icon: IconLocation}).addTo(map)
                                            .bindPopup("<p class='text-center'>"+item.nama_lokasi + gambar + "</p>");
                                        L.layerGroup([tempat]);
                                    });

                                    // $("#printMap").on('click', () => {
                                        L.control.browserPrint().addTo(map);
                                    // });
                                },
                                error: function(error) {
                                    console.error("Terjadi kesalahan saat mengambil data: " + error);
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection