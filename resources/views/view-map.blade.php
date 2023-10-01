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

                    <script>
                        var map = L.map('map', {
                            center: [{{env('LATITUDE')}}, {{env('LONGITUDE')}}],
                            zoom: 14
                        });

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

                        //Marker Place 
                        var gambar1 = "<img src='data/images/al-furqan.jpg' style='width:210px;'>";
                        var alfurqan = L.marker([-6.911661, 107.565236]).addTo(map)
                            .bindPopup('<p>Masjid Al-Furqan Karang Sari<br>' + gambar1 + '</p>');

                        var almanar = L.marker([-6.90944, 107.565311]).addTo(map)
                            .bindPopup('Masjid Al-Mannar Langen Sari');

                        L.layerGroup([alfurqan, almanar]);

                        var myLayer = L.geoJSON().addTo(map);
                        myLayer.addData(geojson);
                    </script>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection