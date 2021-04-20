<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-3 px-5 mb-5">
    <a class="navbar-brand" href="{{ route('kasir') }}">
        <img src="{{ asset('img/Shervie.png') }}" class="img-fluid align-self-center" width="50px" height="50px" alt="Logo">
                Casshier Shervie Juice
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user mr-2"></i> {{ Auth::guard('pegawai')->user()->nama }}
          </a>
          <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
