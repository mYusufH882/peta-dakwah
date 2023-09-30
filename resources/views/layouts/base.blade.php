<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords"
		content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>{{env('APP_NAME')}}</title>

	<link href="{{asset('/adminkit/static/css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
		integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
		integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
	<script src="{{asset('/data/cibeureum.js')}}"></script>
</head>

<body>
	@if (Route::is('login'))
	@yield('login-content')
	<script src="{{asset('/adminkit/static/js/app.js')}}"></script>
	@else
	@auth
	<div class="wrapper">
		@include('layouts.sidebar')

		<div class="main">
			@include('layouts.navbar')

			@yield('content')

			@include('layouts.footer')
		</div>
	</div>

	<script src="{{asset('/adminkit/static/js/app.js')}}"></script>

	<!-- Chart Bar -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>

	<!-- Maps -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var map = L.map('peta', {
				center: [-6.911505531767725, 107.56528992547082],
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
		});
	</script>
	@endauth
	@guest
	<div class="container mt-5">
		<h4 class="text-center">Masuk ke halaman <a href="{{route('login')}}">Login</a></h4>
	</div>
	@endguest
	@endif

</body>

</html>