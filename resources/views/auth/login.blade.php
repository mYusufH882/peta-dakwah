@extends('layouts.base')

@section('login-content')
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <img src="{{asset('/data/images/logopemudapersis.jpeg')}}" alt="Christina Mason"
                            class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        <h1 class="h2">Peta Dakwah PJ Pemuda Persis Cibeureum</h1>
                        <p class="lead">
                            Selamat datang!!! Silahkan Login.
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <form method="POST" action="{{route('loginpost')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input class="form-control form-control @error('username') is-invalid @enderror"
                                            type="text" name="name" placeholder="Masukkan Username" />
                                        @error('username')
                                        <span class="text-danger">Username/Password yang anda masukkan salah!!</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control form-control" type="password" name="password"
                                            placeholder="Masukkan password" />
                                        {{-- <small>
                                            <a href="index.html">Forgot password?</a>
                                        </small> --}}
                                    </div>
                                    {{-- <div>
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" value="remember-me"
                                                name="remember-me" checked>
                                            <span class="form-check-label">
                                                Remember me next time
                                            </span>
                                        </label>
                                    </div> --}}
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-md btn-primary">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection