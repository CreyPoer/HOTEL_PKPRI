<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HOTEL PKPRI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!-- Navbar -->
    @include('layouts.nav')


    <!-- Main Content -->
    <div class="container-fluid">
        <div class="container-lg p-5">
            <div class="row text-center pb-5">
                <h2><b>PROFIL ANDA</b></h2><br>
            </div>
            @foreach($dataPelanggan as $data)

            <div class="row bg-white p-5 mt-3 rounded-4 d-flex align-content-center justify-content-center" style="border: 1px solid black;">
                <div class="rounded-circle" style="width: 150px;height:150px">
                    <img src="{{ asset('storage/image-pelanggan/'.$data->image)}}" class="d-inline-block bg-white rounded-circle border border-4 border-dark-subtle" alt=".." width="150" height="150">
                </div>
                <form class="pt-5" method="POST" action="/simpanprofil/{{ $data->id }}" enctype="multipart/form-data">
                    @if (session()->has('succes'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('succes') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <label for="inputNoKtp" class="col-sm-3 col-form-label">
                            <h6><b>No KTP</b></h6>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputNoKtp" name="no_ktp"
                                value="{{ $data->no_ktp }}" style="border: 1px solid black;">
                            @error('no_ktp')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNama" class="col-sm-3 col-form-label">
                            <h6><b>Nama</b></h6>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="border: 1px solid black;" id="inputNama"
                                name="nama" value="{{ $data->nama }}">
                            @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-3 pt-0">
                            <h6><b>Jenis Kelamin</b></h6>
                        </legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios1"
                                    value="Laki-laki" {{ $data->jenis_kelamin === 'Laki-laki' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gridRadios1">
                                    <h6><b>Laki-laki</b></h6>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios2"
                                    value="Perempuan" {{ $data->jenis_kelamin === 'Perempuan' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gridRadios2">
                                    <h6><b>Perempuan</b></h6>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row mb-3">
                        <label for="inputAlamat" class="col-sm-3 col-form-label">
                            <h6><b>Alamat</b></h6>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="border: 1px solid black;" id="inputAlamat"
                                name="alamat" value="{{ $data->alamat }}">
                            @error('alamat')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNoTelpon" class="col-sm-3 col-form-label">
                            <h6><b>No Telpon</b></h6>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="border: 1px solid black;" id="inputNoTelpon"
                                name="no_telp" value="{{ $data->no_telp }}">
                            @error('no_telp')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-3 col-form-label">
                            <h6><b>Email</b></h6>
                        </label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" style="border: 1px solid black;" id="inputEmail"
                                name="email" value="{{ $data->email }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword10" class="col-sm-3 col-form-label">
                            <h6><b>Password</b></h6>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="border: 1px solid black;"
                                id="inputPassword10" name="password" value="{{ $data->password }}">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="col-sm-1 pt-2">
                            <span id="togglePassword10">
                                <div id="open" style="display: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black"
                                        class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </div>
                                <div id="close" style="display: block;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black"
                                        class="bi bi-eye-slash" viewBox="0 0 16 16">
                                        <path
                                            d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486z" />
                                        <path
                                            d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829" />
                                        <path
                                            d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708" />
                                    </svg>
                                </div>
                            </span>
                        </div> --}}
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-12 col-form-label text-center">
                            <h6><b>Silahkan Pilih Gambar jika anda ingin merubah gambar profil</b></h6>
                        </label>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-3 col-form-label">
                            <h6><b>Gambar</b></h6>
                        </label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <input type="file" name="image" class="form-control col-sm-12" id="inputGroupFile02">
                                {{-- <label class="input-group-text" for="inputGroupFile02">Upload</label> --}}
                            </div>
                            @error('image')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-end">
                        <div class="col-sm-2 p-1">
                            <a href="/pelanggan/{{ $data->id }}" class="btn btn-dark" style="width: 100%;">KEMBALI</a>
                        </div>
                        <div class="col-sm-2 p-1">
                            <button type="submit" class="btn btn-success" style="width: 100%;">SIMPAN</button>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>

        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Bootstrap JS and Popper.js -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script>
        const passwordField = document.getElementById('inputPassword10');
        const togglePassword10 = document.getElementById('togglePassword10');
        const eyeOpen = document.getElementById('open');
        const eyeClose = document.getElementById('close');

        togglePassword10.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle visibility icons
            if (type === 'password') {
                eyeOpen.style.display = 'none';
                eyeClose.style.display = 'block';
            } else {
                eyeOpen.style.display = 'block';
                eyeClose.style.display = 'none';
            }
        });
    </script> --}}

</body>

</html>
