@extends('layouts.base')

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Dashboard</h1>

        {{-- <div class="row">
            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill w-100">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Recent Movement</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="chartjs-dashboard-line"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="row">
            <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                <div class="card flex-fill w-100">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Real-Time</h5>
                    </div>
                    <div class="card-body px-4">
                        <div id="world_map" style="height:350px;"></div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Data anggota</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover my-0" id="tableDashboard">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anggota</th>
                                    <th>Titik Lokasi</th>
                                    <th>Alamat</th>
                                    <th>Tipe</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <script type="text/javascript">
                            $("#tableDashboard").DataTable({
                                pageLength : 3,
                                processing: true,
                                serverSide: true,
                                ajax: "{{ url('/dashboard') }}",
                                columns: [
                                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                    {data: 'nama_lengkap', name: 'nama_lengkap'},
                                    {data: 'titik_lokasi', name: 'titik_lokasi'},
                                    {data: 'alamat', name: 'alamat'},
                                    {data: 'tipe', name: 'tipe'},
                                    {data: 'jabatan_anggota', name: 'jabatan_anggota'},
                                    {
                                        data: 'aksi',
                                        name: 'aksi',
                                        orderable: true, 
                                        searchable: true
                                    },
                                ]
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-3">
                <div class="card flex-fill w-100">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Grafik Anggota PJ Cibeureum</h5>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <canvas id="chartjs-dashboard-bar"></canvas>
                            <!-- Chart Bar -->
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Bar chart
                                    const labels = ['Persis', 'Persistri', 'Pemuda', 'Pemudi', 'Simpatisan'];
                                    new Chart(document.getElementById("chartjs-dashboard-bar"), {
                                        type: "bar",
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                label: "Jumlah",
                                                data: [<?= $data['jmlPersis'] ?>, <?= $data['jmlPersistri'] ?>, <?= $data['jmlPemuda'] ?>, <?= $data['jmlPemudi'] ?>, <?= $data['jmlSimpatisan'] ?>],
                                                backgroundColor: [
                                                    window.theme.primary,
                                                    window.theme.info,
                                                    window.theme.success,
                                                    window.theme.danger,
                                                    window.theme.warning
                                                ],
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
                                                        stepSize: 3
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection