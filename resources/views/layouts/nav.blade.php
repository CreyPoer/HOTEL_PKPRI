<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/home">
            <img src="{{ asset('images/LOGO_PKPRI.PNG') }}" alt="Logo" width="34" height="34"
                class="d-inline-block align-text-top">
            HOTEL KOPERASI
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            @if($home==1)
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    @if (!Auth::user())
                        <a class="nav-link active fw-medium" aria-current="page" href="#scrollspyHeading1">Beranda</a>
                    @endif
                    @if (Auth::user())
                        <a class="nav-link active fw-medium" aria-current="page" href="/pelanggan/{id}">Beranda</a>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link fw-medium dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Kategori Kamar
                    </a>
                    <ul class="dropdown-menu">
                        {{-- <li><a class="dropdown-item" href="{{ route('aula1') }}">Gedung Aula 1</a></li>
                        <li><a class="dropdown-item" href="{{ route('aula2') }}">Gedung Aula 2</a></li> --}}
                        @if (!Auth::user())
                            @foreach ($kategoriKamar as $item )
                                <li><a class="dropdown-item" href="/carikamarhome/{{ $item }}">{{ $item }}</a></li>
                            @endforeach
                        @endif
                        @if (Auth::user())
                            @foreach ($kategoriKamar as $item )
                                <li><a class="dropdown-item" href="/carikamar/{{ $item }}/{{ auth()->user()->id }}">{{ $item }}</a></li>
                            @endforeach
                        @endif

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="#scrollspyHeading3">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="#scrollspyHeading4">Kontak</a>
                </li>
            </ul>
            @else
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    @if (!Auth::user())
                        <a class="nav-link active fw-medium" aria-current="page" href="/home">Beranda</a>
                    @endif
                    @if (Auth::user())
                        <a class="nav-link active fw-medium" aria-current="page" href="/pelanggan/{id}">Beranda</a>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link fw-medium dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Kategori Kamar
                    </a>
                    <ul class="dropdown-menu">
                        {{-- <li><a class="dropdown-item" href="{{ route('aula1') }}">Gedung Aula 1</a></li>
                        <li><a class="dropdown-item" href="{{ route('aula2') }}">Gedung Aula 2</a></li> --}}
                        @if (!Auth::user())
                            @foreach ($kategoriKamar as $item )
                                <li><a class="dropdown-item" href="/carikamarhome/{{ $item }}">{{ $item }}</a></li>
                            @endforeach
                        @endif
                        @if (Auth::user())
                            @foreach ($kategoriKamar as $item )
                                <li><a class="dropdown-item" href="/carikamar/{{ $item }}/{{ auth()->user()->id }}">{{ $item }}</a></li>
                            @endforeach
                        @endif

                    </ul>
                </li>
            </ul>
            @endif
            <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">
                @if (!Auth::user())
                    <li class="nav-item m-1">
                        <a class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#Login" href="#">Masuk</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#Daftar" href="#" id="daftarLink">Daftar</a>
                    </li>
                @endif
                @if (Auth::user())
                    <li class="nav-item dropdown">
                        <a class="navbar-brand fw-medium dropdown-toggle d-flex align-items-center" href="#" style="font-size: 1rem" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                            <img src="{{ asset('gambar-user/'.auth()->user()->image)}}" alt="." width="34" height="34"
                            class="d-inline-block align-text-top bg-white rounded-circle">
                            {{-- <img  src="{{ asset('storage/image-user/'.auth()->user()->image)}}" alt="." width="34" height="34"
                                class="d-inline-block align-text-top bg-white rounded-circle"> --}}
                            Hai, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/lihatprofil/{{ auth()->user()->id }}">Profile</a></li>
                            @if($jumlah==0)
                                <li><a class="dropdown-item" href="/pesananpelanggan/{{ auth()->user()->id }}">Pemesanan</a></li>
                            @else
                                <li><a class="dropdown-item" href="/pesananpelanggan/{{ auth()->user()->id }}">Pemesanan</a></li>
                            @endif
                            <li><a class="dropdown-item" href="/logout">Keluar</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@if (session()->has('succesLogin'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('succesLogin') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Modal  Login-->
<div class="modal fade" id="Login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #ededed;" >
        <h1 class="modal-title fs-4 fw-bold text-dark" id="exampleModalLabel">
            <img src="{{ asset('images/LOGO_PKPRI.PNG')}}" alt="Logo" width="36" height="36"
                class="d-inline-block align-text-top">
                Login
            </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/login" method="POST">
            <div class="modal-body bg-dark">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email</label>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="floatingInputPassword2" placeholder="Password">
                    <label for="floatingInputPassword2">Password</label>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <span id="togglePassword2">
                        <div id="terbuka2" class="text-end " style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                            </svg>
                        </div>
                        <div id="tertutup2" class="text-end" style="display: block; padding-top:1px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486z"/>
                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                            <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708"/>
                            </svg>
                        </div>
                    </span>
                </div>
            </div>
            <div class="modal-footer" style="background-color: #ededed;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info rounded">Login</button>
            </div>
        </form>
    </div>
    </div>
</div>

<!-- Modal  Daftar-->
<div class="modal fade" id="Daftar" tabindex="-1" aria-labelledby="DaftarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="width: 35rem;">
        <div class="modal-header" style="background-color: #ededed;border-radius:15px 15px 0px 0px;">
          <h2 class="modal-title fs-4 fw-bold" id="DaftarLabel">
          <img src="{{ asset('images/LOGO_PKPRI.PNG')}}" alt="Logo" width="45" height="45"
          class="d-inline-block align-text-top ">
          FORMULIR PENDAFTARAN</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color: black;color:#ededed;">
          <form method="post" action="/daftarpelanggan" enctype="multipart/form-data" class="row g-3" style="padding: 1rem;">
              @csrf
              <div class="col-md-6 form-floating">
                  <input type="text" name="no_ktp" class="form-control" id="floatingInput" placeholder="NO KTP">
                  <label for="floatingInput" style="color:black;">NO KTP</label>
                  @error('no_ktp')
                  <small class="text-danger">{{ $message }}</small>
                 @enderror
              </div>
              <div class="col-md-6 form-floating">
                  <input type="text" name="nama" class="form-control" id="floatingInput" placeholder="NAMA ANDA">
                  <label for="floatingInput" style="color:black;">NAMA</label>
                  @error('nama')
                  <small class="text-danger">{{ $message }}</small>
                 @enderror
              </div>

              <label for="">Jenis Kelamin</label>
              <div class="col-md-6">
                  <input type="radio" name="jenis_kelamin" class="btn-check" name="options-outlined" value="Laki-laki" id="info-outlined" autocomplete="off" >
                  <label class="btn btn-outline-info" for="info-outlined" style="width: 100%;">Laki-Laki</label>
              </div>
              <div class="col-md-6">
                  <input type="radio" name="jenis_kelamin" class="btn-check" name="options-outlined" value="Perempuan" id="danger-outlined" autocomplete="off">
                  <label class="btn btn-outline-danger" for="danger-outlined" style="width: 100%;">Perempuan</label>
              </div>
              @error('jenis_kelamin')
              <small class="text-danger">{{ $message }}</small>
             @enderror
              <div class="col-md-6 form-floating">
                  <input type="text"  name="no_telp" class="form-control" id="floatingInput" placeholder="NOMOR TELPON ANDA">
                  <label for="floatingInput" style="color:black;">NOMOR TELPON</label>
                  @error('no_telp')
                  <small class="text-danger">{{ $message }}</small>
                 @enderror
              </div>
              <div class="col-md-6 form-floating">
                  <input type="text"  name="alamat" class="form-control" id="floatingInput" placeholder="ALAMAT ANDA">
                  <label for="floatingInput" style="color:black;">ALAMAT</label>
                  @error('alamat')
                  <small class="text-danger">{{ $message }}</small>
                 @enderror
              </div>
              <div class="col-6 form-floating">
                  <input type="email"  name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                  <label for="floatingInput" style="color:black;">EMAIL</label>
                  @error('email')
                  <small class="text-danger">{{ $message }}</small>
                 @enderror
              </div>
              <div class="col-6 form-floating">
                  <input type="password"  name="password" class="form-control" id="floatingInputPassword" placeholder="name@example.com">
                  <label for="floatingInputPassword" style="color:black;">PASSWORD</label>
                  @error('password')
                  <small class="text-danger">{{ $message }}</small>
                 @enderror
                  <span id="togglePassword">
                      <div id="terbuka" style="display: none;margin-left:13rem;">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                          </svg>
                      </div>
                      <div id="tertutup" style="display: block;margin-left:13rem; padding-top:5px;">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                          <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486z"/>
                          <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                          <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708"/>
                          </svg>
                      </div>
                  </span>
              </div>
              <label for="">Gambar (JPG/JPEG)</label>
              <div class="input-group mb-3">
                  <input type="file"  name="image" class="form-control" id="inputGroupFile02">
                  <label class="input-group-text" for="inputGroupFile02">Upload</label>
              </div>
              @error('image')
              <small class="text-danger">{{ $message }}</small>
             @enderror
          </div>
          <div class="modal-footer" style="background-color: #ededed;border-radius: 0px 0px 20px 20px;">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">KEMBALI</button>
              <button type="submit" class="btn btn-success">DAFTAR</button>
          </div>
      </form>
      </div>
    </div>
  </div>

  <script>
    function triggerDaftarModal() {
        // Use jQuery or plain JavaScript to trigger the modal
        $('#Daftar').modal('show'); // If you are using jQuery
        // OR
        // document.getElementById('Daftar').classList.add('show'); // If you are not using jQuery
    }
</script>

