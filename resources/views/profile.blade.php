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
                        <div class="container text-center">
                            <img src="{{asset('/adminkit/static/img/avatars/avatar.jpg')}}" alt="Christina Mason"
                                class="img-fluid rounded-circle mb-2" width="128" height="128" />
                            <h5 class="card-title mb-0">{{Auth::user()->name}}</h5>
                        </div>

                        <form action="#" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <input type="text" id="username" class="form-control" value="{{Auth::user()->name}}"
                                    placeholder="Username">
                            </div>
                            <div class="form-group mb-3">
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