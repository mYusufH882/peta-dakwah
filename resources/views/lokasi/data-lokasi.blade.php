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
                            <span class="text-bold">{{Session::get('success')}}</span>
                        </div>
                        @endif
                        <div id="messageDiv" class="alert alert-success" style="display:none;">
                            <p id="messageText"></p>
                        </div>

                        <div class="table-responsive">
                            <a href="{{route('data-lokasi.create')}}" class="btn btn-sm btn-success mb-3"><i
                                    class="align-middle" data-feather="plus"></i>
                                <span class="align-middle">Tambah Data Lokasi</span></a>
                            <table class="table table-bordered table-striped" id="tableLokasi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lokasi</th>
                                        <th>Alamat</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <script type="text/javascript">
                                $(function() {
                                var table = $("#tableLokasi").DataTable({
                                    responsive: true,
                                    processing: true,
                                    serverSide: true,
                                    ajax: "{{ route('data-lokasi.index') }}",
                                    columns: [
                                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                        {data: 'nama_lokasi', name: 'nama_lokasi'},
                                        {data: 'alamat', name: 'alamat'},
                                        {data: 'latitude', name: 'latitude'},
                                        {data: 'longitude', name: 'longitude'},
                                        {
                                            data: 'aksi',
                                            name: 'aksi',
                                            orderable: true, 
                                            searchable: true
                                        },
                                    ]
                                });

                                $(document).on('click', '.delete', function() {
                                    var id = $(this).data('id');
                                    var url = '{{ route('data-lokasi.destroy', ':id') }}';
                                    url = url.replace(':id', id);
                                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                    
                                    // Munculkan modal Delete
                                    $('#deleteModal').modal('show'); 
                                    $('#deleteModal .btn-danger').on('click', function() {
                                        $.ajax({
                                            type: 'DELETE',
                                            url: url,
                                            headers: {
                                                'X-CSRF-TOKEN': csrfToken
                                            },
                                            success: function (data) {
                                                $('#deleteModal').modal('hide');
                                                location.reload();
                                            }
                                        });
                                    });
                                });
                            });
                            </script>
                        </div>
                        @include('modal.deleteLokasi')
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection