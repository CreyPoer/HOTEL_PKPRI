<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HOTEL PKPRI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    {{-- <style>

        body {
            /* width: 100%; */
            background-color: #ededed;
            font-family: 'Poppins', sans-serif;

        }

        .navbar {
            background-color: #343a40; /* Bootstrap dark background color */
            width: 100%;
            border-bottom: 3px solid black;
            height: 75px;

        }

        .navbar a {
            color: white !important; /* Ensure link text is white */
        }

        .dropdown-menu a {
            color: #000 !important; /* Set your desired text color */
        }

        footer {
            width: auto;
            height: 270px;
            background-color: #1C211C;
            box-sizing: border-box;
            padding: 40px 88px;
            margin-top: 80px;
        }

        @media screen and (max-width: 1000px) {
            footer {
                height: auto;
                background-color: #1C211C;
            }

            footer .w-25 {
                width: 50% !important;
            }
        }

        @media screen and (max-width: 770px) {
            footer .w-25 {
                width: 70% !important;
            }
            .navbar-collapse{
                z-index: 1000;
            }
        }

        @media screen and (max-width: 500px) {
            footer .w-25 {
                width: 100% !important;
            }
        }

        /* Additional styling for the form section */
        .form-section {
            margin-top: 30px;
        }

        @media (min-width: 992px) {
            .form-section {
                margin-top: 0; /* Reset margin for larger screens */
            }
        }

    </style> --}}
</head>
<body>
    <!-- Navbar -->
    @include('layouts.nav')
    @if (session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {!! session('loginError') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Main Content -->
    <section class="container-fluid">
        <div class="container mt-3 ">
            <div class="row">
                <div class="col-lg-3 mt-3">
                    <div class="card mb-3 bg-dark text-light">
                        <div class="card-body ">
                            @if($status==0)
                            <form method="post" action="/checketersediaanhome" class="row">
                                @csrf
                                <div class="col-sm-12 pt-2">
                                    <label for="staticEmail2"><b>TANGGAL CHECK-IN</b></label>
                                    <input type="date" name="checkin" class="form-control form-control-lg" id="inputPassword2">
                                    {{-- <input type="hidden" name="id_pelanggan" value="> --}}
                                </div>
                                <div class="col-sm-12 pt-2">
                                    <label for="staticEmail2" ><b>TANGGAL CHECK-OUT</b></label>
                                    <input type="date" name="checkout" class="form-control form-control-lg" id="inputPassword2">
                                </div>
                                <div class="col-sm-12 pt-2">
                                    <label for="staticEmail2" ><b> JENIS KAMAR</b></label>
                                    <select name="jenis_kamar" class="form-select form-select-lg" aria-label="Default select example">
                                        <option value="kosong" selected>Pilih Jenis Kamar</option>
                                        @foreach ($jeniskamar as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 pt-2">
                                    <button type="submit" class="btn btn-outline-light btn-lg" style="width:100%"><b>Cek Ketersediaan</b></button>
                                    </div>
                            </form>
                            @elseif($status==1)
                            <form method="post" action="/checketersediaanpelanggan" class="row">
                                <div class="col-sm-12 pt-2">
                                    <label for="staticEmail2"><b>TANGGAL CHECK-IN</b></label>
                                    <input type="date" name="checkin" class="form-control form-control-lg" value="{{ $checkin }}" readonly id="inputPassword2">
                                </div>
                                <div class="col-sm-12 pt-2">
                                    <label for="staticEmail2" ><b>TANGGAL CHECK-OUT</b></label>
                                    <input type="date" name="checkout" class="form-control form-control-lg" value="{{ $checkout }}" readonly id="inputPassword2">
                                </div>
                                <div class="col-sm-12 pt-2">
                                    <label for="staticEmail2" ><b>JENIS KAMAR</b></label>
                                    <input type="text" name="checkout" class="form-control form-control-lg" value="{{ $jkamar }}" readonly id="inputPassword2">
                                </div>
                                <div class="col-sm-12 pt-2">
                                    <a type="submit" href="/resetketersediaan" class="btn btn-outline-light btn-lg" style="width:100%"><b>RESET</b></a>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- "Macam Kamar" Section -->
                <div class="col-lg-9 mt-3 ">
                    <div class="container">
                        <div class="card p-3">
                            <div class="row">
                                @if($status==1)
                                @if($pakejeniskamar==1)
                                <div class="col-lg-6 my-2 pb-3 my-sm-0">
                                    <div class="card p-3 card-efek">
                                        <img src="{{ asset('storage/image-kamar/'.$kamar->image)}}" class="card-img-top" alt="..." width="10rem" height="160rem">
                                        <div class="card-body d-flex flex-column">
                                            <h2 class="card-title text-center fw-semibold">{{ $kamar->jenis_kamar }}</h2>
                                            <div class="card-text d-flex flex-row justify-content-evenly">
                                                <h2 class="link-underline-dark">{{ 'Rp.' . number_format($kamar->harga_permalam , 2, ',', '.') }} </h2>
                                                <p class="fw-semibold mt-2">/ malam</p>
                                            </div>
                                            <h5 class="card-title text-center">Tersedia {{ $totaltersedia }} Kamar</h5>
                                        </div>
                                        <a data-bs-toggle="modal" data-bs-target="#Login" href="#" class="btn btn-dark mt-3" style="width: 100%;">Pesan Sekarang </a>
                                    </div>
                                </div>
                                @elseif($pakejeniskamar==0)
                                @foreach ($roomAvailability as $kamar )
                                @if($kamar['ketersediaan']>0)
                                <div class="col-lg-6 my-2 pb-3 my-sm-0">
                                    <div class="card p-3 card-efek">
                                        <img src="{{ asset('storage/image-kamar/'.$kamar['image'])}}" class="card-img-top" alt="..." width="10rem" height="180rem">
                                        <div class="card-body d-flex flex-column">
                                            <h2 class="card-title text-center fw-semibold">{{ $kamar['jenis_kamar'] }}</h2>
                                            <div class="card-text d-flex flex-row justify-content-evenly">
                                                <h2 class="link-underline-dark">{{ 'Rp.' . number_format($kamar['harga_permalam'] , 2, ',', '.') }} </h2>
                                                <p class="fw-semibold mt-2">/ malam</p>
                                            </div>
                                            <h5 class="card-title text-center">Tersedia {{ $kamar['ketersediaan'] }} Kamar</h5>
                                        </div>
                                        <a data-bs-toggle="modal" data-bs-target="#Login" href="#" class="btn btn-dark mt-3" style="width: 100%;">Pesan Sekarang </a>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endif
                                @elseif($status==0)
                                @foreach($KamarTertentu as $data)

                                <div class="col-lg-6 my-2 pb-3 my-sm-0">
                                    <div class="card p-3 card-efek">
                                        <img src="{{ asset('storage/image-kamar/'.$data->image)}}" class="card-img-top" alt="..." width="10rem" height="160rem">
                                        <div class="card-body d-flex flex-column">
                                            <h2 class="card-title text-center fw-semibold">{{ $data->jenis_kamar }}</h2>
                                            <div class="card-text d-flex flex-row justify-content-evenly">
                                                <h2 class="link-underline-dark">{{ 'Rp.' . number_format($data->harga_permalam , 2, ',', '.') }} </h2>
                                                <p class="fw-semibold mt-2">/ malam</p>
                                            </div>
                                            <h5 class="card-title text-center">Tersedia {{ $data->ketersediaan }} Kamar</h5>
                                        </div>
                                        <a data-bs-toggle="modal" data-bs-target="#Login" href="#" class="btn btn-dark mt-3" style="width: 100%;">Pesan Sekarang </a>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('layouts.footer')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}

    <!-- Bootstrap JS and Popper.js -->


    </body>
    </html>
