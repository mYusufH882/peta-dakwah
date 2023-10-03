@extends('layouts.base')

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="row justify-content-center">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Pengaturan</h1>
            </div>
            <div class="col-md-8 col-xl-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-center">Profile Details</h5>
                    </div>
                    <div class="card-body h-100">
                        @if (Session::has('success'))
                        <div class="alert alert-success">
                            <span class="text-bold">{{Session::get('success')}}</span>
                        </div>
                        @endif
                        <div class="container text-center">
                            <img src="{{asset('/adminkit/static/img/avatars/avatar.jpg')}}" alt="Christina Mason"
                                class="img-fluid rounded-circle mb-2" width="128" height="128" />
                            <h5 class="card-title mb-0">{{ucfirst(Auth::user()->nama_lengkap)}}</h5>
                        </div>

                        <form action="{{route('updateProfile', Auth::user()->id)}}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="username" class="mb-auto"><b>Username :</b></label>
                                <input type="text" name="name" id="username" class="form-control"
                                    value="{{Auth::user()->name}}" placeholder="Username">
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama_lengkap" class="mb-auto"><b>Nama Lengkap :</b></label>
                                <input type="text" name="nama_lengkap" class="form-control"
                                    value="{{Auth::user()->nama_lengkap}}" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="mb-auto"><b>Email :</b></label>
                                <input type="email" id="email" class="form-control" value="{{Auth::user()->email}}"
                                    placeholder="Email" readonly>
                            </div>
                            <button type="submit" class="btn btn-warning text-white"><i class="align-middle"
                                    data-feather="edit"></i> <span class="align-middle">Ubah</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection