@extends('layouts.base')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Data Masjid</h1>
        </div>
        <div class="row">
            <div class="col-md col-xl">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">Data Masjid</h5>
                    </div>
                    <div class="card-body">
                        @if (Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{Session::get('success')}}</p>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <a href="{{route('data-lokasi.create')}}" class="btn btn-sm btn-success mb-3"><i
                                    class="align-middle" data-feather="plus"></i>
                                <span class="align-middle">Tambah Data Lokasi</span></a>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Masjid</th>
                                        <th>Overview</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection