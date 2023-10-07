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
                        <div id="map" style="height: 500px;"></div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            $.ajax({
                                url: "/get-lokasi",
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

                                    var memberIcon = L.icon({
                                        iconUrl: '/data/images/location.png',
                                        iconSize:     [40, 50], // size of the icon
                                    });

                                    data.forEach(function(item) {
                                        //Marker Members
                                        var gambar = (item.user.avatar) ? "<img src='foto/"+item.user.avatar+"' class='mx-auto d-block' style='width:150px;'>" : "<small>Gambar belum tersedia!!!</small>";
                                        var anggota = L.marker([item.latitude, item.longitude], {icon: memberIcon}).addTo(map)
                                            .bindPopup(item.user.nama_lengkap + "<br>" + gambar);
                                        L.layerGroup([anggota]);
                                    });

                                    //Info Tempat
                                    // data.forEach(function(item) {
                                    //     //Marker Place 
                                    //     var gambar = (item.gambar_lokasi) ? "<img src='data/images/"+item.gambar_lokasi+"' class='mx-auto d-block' style='width:210px;'>" : "<small>Gambar belum tersedia!!!</small>";
                                    //     var tempat = L.marker([item.latitude, item.longitude]).addTo(map)
                                    //         .bindPopup(item.nama_lokasi + "<br>" + gambar);
                                    //     L.layerGroup([tempat]);
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