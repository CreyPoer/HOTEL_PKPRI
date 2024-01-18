<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOTEL PKPRI</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" /> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

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
    @if (session()->has('succes'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('succes') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


    <!-- Konten utama -->
    <section class="container-fluid" id="scrollspyHeading1">
        <div class="acuan-bg">
            <div class="banner">
                <div class="position-relative top-50 start-50 translate-middle text-center text-white">
                    <h1>SELAMAT DATANG DI HOTEL PKPRI BANGKALAN</h1><br>
                    <a type="button" class="btn btn-outline-light" href="/resetketersediaan"><b>PESAN SEKARANG</b></a>
                </div>
                <div class="p-3 bg-dark shadow-lg position-absolute top-100 start-50 translate-middle rounded-3">
                    <form method="post" action="/checketersediaanhome" class="d-flex flex-wrap justify-content-center">
                        @csrf
                        {{-- <div class="row"> --}}
                            <div class="col-lg-4 px-1">

                                <label for="checkIn" class="form-label text-light fw-semibold">TANGGAL CHECK-IN</label>
                                <input type="date" name="checkin" class="form-control" id="checkIn">
                            </div>
                            <div class="col-lg-4 px-1">
                                <label for="checkOut" class="form-label text-light fw-semibold">TANGGAL CHECK-OUT</label>
                                <input type="date" name="checkout" class="form-control" id="checkOut">
                            </div>
                            <div class="col-lg-4 px-1">
                                <label for="jenisKamar" class="form-label text-light fw-semibold">JENIS KAMAR</label>
                                <select class="form-select text-dark" name="jenis_kamar" aria-label="Default select example">
                                <option  value="kosong" selected>Pilih Jenis Kamar</option>
                                @foreach ($jeniskamar as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <button type="submit" class="btn btn-outline-light btn-lg w-100 fs-6">Cek Ketersediaan</button>
                            </div>
                        {{-- </div> --}}
                    </form>
                </div>
            </div>
        </div>
        {{-- <img src="{{ asset('images/bahan1.jpeg') }}" alt="" style="width: 100%;height:650px;"> --}}
    </section>


    <div class="container mt-5">
        <h2 class="text-center fw-medium pt-5">PENAWARAN KAMI</h2>
        <hr style="border: 1px solid black;">
        <div class="row">
            @foreach($dataKamar as $data)
                <div class="col-lg-4 my-2 pt-2 my-sm-0">
                    <div class="card p-3">
                        <img src="{{ asset('storage/image-kamar/'.$data['kamar']->image)}}" class="card-img-top" alt="..." width="10rem" height="160rem">
                        <div class="card-body d-flex flex-column">
                            <h2 class="card-title text-center">{{ $data['kamar']->jenis_kamar }}</h2>
                            <div class="card-text d-flex flex-row justify-content-evenly">
                                <h2 class="link-underline-dark">{{ 'Rp.' . number_format($data['kamar']->harga_permalam , 0, ',', '.') }} </h2>
                                <p class="fw-semibold mt-2">/ malam</p>
                            </div>
                        </div>
                        @if( $data['rata_rating']==5)
                            @include('layouts.rating-5')
                        @elseif($data['rata_rating']==4.5)
                            @include('layouts.rating-45')
                        @elseif($data['rata_rating']==4)
                            @include('layouts.rating-4')
                        @elseif($data['rata_rating']==3.5)
                            @include('layouts.rating-35')
                        @elseif($data['rata_rating']==3)
                            @include('layouts.rating-3')
                        @elseif($data['rata_rating']==2.5)
                            @include('layouts.rating-25')
                        @elseif($data['rata_rating']==2.0)
                            @include('layouts.rating-2')
                        @elseif($data['rata_rating']==1.5)
                            @include('layouts.rating-15')
                        @elseif($data['rata_rating']==1.0)
                            @include('layouts.rating-1')
                        @elseif($data['rata_rating']==0.5)
                            @include('layouts.rating-1')
                        @endif
                            <a href="/carikamarhome/{{ $data['kamar']->jenis_kamar}}" class="btn btn-dark mt-3" style="width: 100%;">Lihat Detail Penawaran </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="container p-0 my-5">
            <div class="row ps-4">
                <div class="col-sm-7">
                    <h2 id="scrollspyHeading3">Selamat Datang di Website</h2><br>
                    <h2 class="fs-2">HOTEL PKPRI BANGKALAN</h2><br>
                    <p class="indented-paragraph">
                    Hotel PKPRI Bangkalan mempersembahkan pengalaman menginap yang berkesan dan nyaman di pusat Kota Bangkalan. Dengan lokasi yang strategis, hotel ini memiliki beberapa keunggulan, antara lain:
                    Dekat dengan pusat perbelanjaan,
                    Terdapat wisata kuliner yang tidak jauh dari hotel,
                    Dekat dengan pusat pemerintahan dan alun-alun Kota Bangkalan.
                    </p><br>
                    <p class="indented-paragraph">
                    Hal ini mempermudah tamu yang ingin menginap sambil menikmati wisata di Kota Bangkalan. Hotel ini dilengkapi dengan fasilitas-fasilitas modern seperti koneksi Wi-Fi yang cepat, AC, serta area istirahat yang nyaman, dijamin akan membuat pengalaman menginap Anda menjadi lebih menyenangkan.
                    Selain itu, hotel ini juga menyediakan fasilitas tambahan seperti layanan kamar yang siap melayani kebutuhan Anda 24 jam, ruang pertemuan untuk keperluan bisnis. Dengan layanan yang ramah dan fasilitas yang lengkap, Hotel PKPRI Bangkalan menjadi pilihan ideal bagi para wisatawan, pelancong bisnis, atau siapa pun yang menginginkan pengalaman menginap yang istimewa di Bangkalan.
                    </p>
                </div>
                <div class="col-sm-4">
                    <img src="{{ asset('images/bahan6.jpeg')}}" alt="..." class="img-fluid">
                </div>
            </div>

        </div>

        <h5 class="text-center">"Segala masukan dan saran anda amat sangat kami butuhkan untuk kemajuan layanan kami kedepannya"</h5>
        <div class="container p-0 m-0">
            <div class="row">
                <div class="card col-sm-6 mb-sm-0 p-2">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d281.2253299740016!2d112.74983739260833!3d-7.024635083531738!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd80f62bbd566d1%3A0xc7268430ecc45dac!2sKoperasi%20KPRI%20Kab%20Bangkalan!5e0!3m2!1sid!2sid!4v1704261433808!5m2!1sid!2sid" height="325" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-sm-5 p-3 mb-sm-0 container bg-black rounded-3">
                    <form  method="POST" action="/simpanmasukan" class="row g-2">
                        @csrf
                        <div class="col-md-6 form-floating ps-1">
                            <input type="text" name="nama" class="form-control" id="floatingInput1" placeholder="Nama Anda">
                            <label for="floatingInput1">Nama Anda</label>
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-floating ps-1">
                            <input type="email" name="email" class="form-control" id="floatingInput2" placeholder="nameemail@example.com">
                            <label for="floatingInput2">Email Anda</label>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 ps-1">
                            <select class="form-select form-select" aria-label="Default select example" name="subjek">
                                <option selected>Pilih Subjek Masukan</option>
                                <option value="Pengalaman Mengakses Website">Pengalaman Mengakses Website</option>
                                <option value="Pengalaman Menginap Di Hotel">Pengalaman Menginap Di Hotel</option>
                                <option value="Pelayanan Hotel yang Di Terima">Pelayanan Hotel yang Di Terima</option>
                                <option value="Fasilitas Hotel yang Di Tawarkan">Fasilitas Hotel yang Di Tawarkan</option>
                            </select>
                            @error('subjek')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 form-floating ps-1">
                            <textarea class="form-control" name="feedback" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px;"></textarea>
                            <label for="floatingTextarea2">Masukan Anda</label>
                            @error('feedback')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-light border-1 fw-medium" style="width: 100%">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Footer --}}
    @include('layouts.footer')

    <!-- Script Bootstrap (taruh di akhir body) -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script> -->
    {{-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script> --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
  </body>
</html>
