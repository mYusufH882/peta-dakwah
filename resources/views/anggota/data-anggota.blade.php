@extends('layouts.base')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Data Anggota</h1>
        </div>
        <div class="row">
            <div class="col-md col-xl">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">Data Anggota</h5>
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
                            <a href="{{route('data-anggota.create')}}" class="btn btn-sm btn-success mb-3"><i
                                    class="align-middle" data-feather="plus"></i>
                                <span class="align-middle">Tambah Data Anggota</span></a>
                            <table class="table table-bordered table-striped" id="tableAnggota">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Tipe & Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <script type="text/javascript">
                                $(function() {
                                var table = $("#tableAnggota").DataTable({
                                    responsive: true,
                                    processing: true,
                                    serverSide: true,
                                    ajax: "{{ route('data-anggota.index') }}",
                                    columns: [
                                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                        {data: 'foto', name: 'foto'},
                                        {data: 'nama', name: 'nama'},
                                        {data: 'alamat', name: 'alamat'},
                                        {data: 'tipe_jabatan', name: 'tipe_jabatan'},
                                        {data: 'aksi', name: 'aksi'},
                                    ]
                                });

                                $(document).on('click', '.delete', function() {
                                    var id = $(this).data('id');
                                    var url = '{{ route('data-anggota.destroy', ':id') }}';
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
                        @include('modal.delete')
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection