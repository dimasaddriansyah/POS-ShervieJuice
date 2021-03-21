<nav class="navbar navbar-expand-lg navbar-light bg-white py-2 px-4 mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('kasir') }}">
                <img src="{{ asset('img/Shervie.png') }}" class="img-fluid align-self-center" width="50px" height="50px" alt="Logo">
                Casshier Shervie Juice
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle me-1"></i>
                        {{ Auth::guard('pegawai')->user()->nama }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item py-2" href="#"><i class="bi bi-pencil-square me-1"></i> Profile</a></li>
                        <li><a class="dropdown-item text-danger py-2" href="{{ route('logout') }}"><i class="bi bi-box-arrow-in-right me-1"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
