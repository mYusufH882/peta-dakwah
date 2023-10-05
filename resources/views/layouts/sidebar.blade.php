<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        {{-- <a class="sidebar-brand" href="{{route('dashboard')}}">
            {{env('APP_NAME')}}
        </a> --}}
        <h1 class="sidebar-brand">{{env('APP_NAME')}}</h1>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{Route::is('dashboard') ? " active" : "" }}">
                <a class="sidebar-link" href="{{route('dashboard')}}">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{Route::is('data-lokasi.*') ? " active" : "" }}">
                <a class="sidebar-link" href="{{route('data-lokasi.index')}}">
                    <i class="align-middle" data-feather="map-pin"></i> <span class="align-middle">Data Lokasi</span>
                </a>
            </li>

            <li class="sidebar-item {{Route::is('data-anggota.*') ? " active" : "" }}">
                <a class="sidebar-link" href="{{route('data-anggota.index')}}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data Anggota</span>
                </a>
            </li>

            <li class="sidebar-item {{Route::is('peta') ? " active" : "" }}">
                <a class="sidebar-link" href="{{route('peta')}}">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                </a>
            </li>

            <li class="sidebar-header">
                Pengaturan
            </li>

            <li class="sidebar-item {{Route::is('profile') ? " active" : "" }}">
                <a class="sidebar-link" href="{{route('profile')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>
        </ul>
    </div>
</nav>