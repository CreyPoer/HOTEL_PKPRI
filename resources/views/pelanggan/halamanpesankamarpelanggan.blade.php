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
    <style>


    </style>
</head>

@include('layouts.nav')

<!-- Konten utama -->
    <div class="container-fluid">
        <div class="container mt-3">
            <h3 class="text-center text-dark">--RESERVASI KAMAR PELANGGAN--</h3>
            <div class="row">
                {{-- <div class="row p-4"> --}}
                    @if ($check == 1)
                        <div class="col-md-6 px-4 mt-5">
                            <h3 class="text-center text-black">Formulir Cek Ketersediaan</h3>
                            <div class="bg-dark p-3 rounded-4">
                                <form method="POST" action="/checketersediaan" class="p-2">
                                    @csrf
                                        <div class="mb-3" >
                                            <label for="staticEmail2" class="text-light "><b>TANGGAL CHECK-IN</b></label>
                                            <input type="date" name="checkin" class="form-control form-control-lg" id="inputPassword2">
                                            <input type="hidden" value="{{ auth()->user()->id }}" name="id" class="form-control form-control-lg" id="inputPassword2">
                                            <input type="hidden" value="{{ $nama }}" name="jenis_kamar" class="form-control form-control-lg" id="inputPassword2">
                                        </div>
                                        <div class="mb-3" >
                                            <label for="staticEmail2" class="text-light"><b>TANGGAL CHECK-OUT</b></label>
                                            <input type="date" name="checkout" class="form-control form-control-lg" id="inputPassword2">
                                        </div>
                                    <div class="mt-4 mb-3">
                                        <button type="submit" class="btn btn-outline-light btn-lg w-100"><b style="font-size: 16px;">Cek Ketersediaan Sekarang</b></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @elseif($check == 0)
                        <div class="col-md-6 p-4 mt-4">
                            <h3 class="text-center text-black">Formulir Cek Ketersediaan</h3><br>
                            <form method="post" action="/pesankamarpelanggan" class="row rounded-4 g-3 bg-dark border border-light p-4 ">
                                @csrf
                                <div class="col-md-6">
                                    <label for="check_in" class="form-label text-light"><b>TANGGAL CHECK-IN</b></label>
                                    <input type="date" name="check_in" class="form-control form-control-lg" id="check_in" value="{{ $checkin }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="check_out" class="form-label text-light"><b>TANGGAL CHECK-OUT</b></label>
                                    <input type="date" name="check_out" class="form-control form-control-lg" id="check_out" value="{{ $checkout }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <a href="/lihatkamar/{{ $nama }}/{{ auth()->user()->id }}" class="btn btn-outline-light btn-lg w-100"><b>Reset Tanggal</b></a>
                                </div>
                                <div class="col-md-12 mt-3 text-center">
                                    <h6 class="text-light"><b>TERSEDIA {{ $totaltersedia }} KAMAR</b></h6>
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl_pesan" class="form-label text-light"><b>TANGGAL RESERVASI</b></label>
                                    <input type="date" name="tgl_pesan" class="form-control form-control-lg" id="tgl_pesan" value="{{ $tanggalHariIni }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="lama_inap" class="form-label text-light"><b>LAMA NGINAP</b></label>
                                    <input type="number" name="lama_inap" class="form-control form-control-lg" id="lama_inap" onchange="hitungTotal_Harga()" value="{{ $lama_nginap ?? 1 }}" min="1" max="{{ $selisihHari }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="jumlah_kamar" class="form-label text-light"><b>JUMLAH KAMAR</b></label>
                                    <input type="number" name="jumlah_kamar" class="form-control form-control-lg" id="jumlah_kamar" onchange="hitungTotal_Harga()" value="{{ $jumlah_kamar ?? 1 }}" min="1" max="{{ $totaltersedia }}">
                                    @foreach($dtKamar as $data)
                                        <input type="hidden" name="pelanggan_id" value="{{ auth()->user()->id  }}">
                                        <input type="hidden" name="kamar_id" value="{{ $data['kamar']->id }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="total_harga" class="form-label text-light"><b>TOTAL HARGA</b></label>
                                        <input type="number" name="total_harga" class="form-control form-control-lg" id="total_harga" value="{{ $data['kamar']->harga_permalam }}" readonly>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-outline-light btn-lg w-100"><b>Reservasi Sekarang</b></button>
                                    </div>
                                @endforeach
                                <div class="col-md-12 mt-3">
                                    <a type="button" href="/lihatkamar/{{ $nama }}/{{ auth()->user()->id }}" class="btn btn-outline-light btn-lg w-100"><b>Kembali</b></a>
                                </div>
                            </form>
                        </div>
                    @elseif($check == 2)
                        <div class="col-md-6 d-flex justify-content-center mt-5">
                            <div class="alert alert-warning " role="alert" style="text-align: center; width: 36rem; color: black;">
                                <h1>MAAF</h1><br>
                                <h6>Jenis Kamar <b>{{ $nama }}</b> yang anda cari sedang tidak tersedia pada tanggal <b>{{ $checkin }}</b> sampai dengan tanggal <b>{{ $checkout }}</b></h6><br>
                                <img src="{{ asset('video/not-found.gif') }}" alt="GIF Image" width="200" height="280" ><br>
                                <h6>Mohon maaf atas ketidaknyamanannya pelayanan yang kami tawarkan, Silahkan anda bisa mencoba untuk mengecek tanggal lain</h6>
                                <div class="col-auto p-1">
                                    <a href="/lihatkamar/{{ $nama }}/{{ auth()->user()->id }}" class="btn btn-outline-dark btn-lg" style="width:32.2rem;"><b>RESET TANGGAL</b></a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6 px-lg-5 mt-5">
                        <div class="d-flex flex-column justify-content-center">
                            <h3 class="text-center text-black">Jenis Kamar Pilihan Anda</h3>
                            @foreach($dtKamar as $data)
                            <div class="card shadow-lg">
                                <img src="{{ asset('images/bahan1.jpeg')}}" class="card-img-top" alt="...">
                                <div class="card-body" style="background-color: #ededed">
                                    <h3 class="card-title text-center" style="background-color: black;color:white;">{{ $data['kamar']->jenis_kamar }}</h3>
                                    <div class="card-text d-flex flex-row justify-content-evenly">
                                        <h2 class="fw-semibold">{{ 'Rp.' . number_format($data['kamar']->harga_permalam , 0, ',', '.') }} </h2>
                                        <p class="fw-semibold mt-2">/ malam</p>
                                    </div>
                                    <hr>
                                    <div class="d-flex flex-column">
                                        <div class="row">
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">Kapasitas </div>
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">: {{ $data['kamar']->kapasitas }} Orang</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">Kamar Tidur </div>
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">: {{ $data['kamar']->bed }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">Pendingin Ruangan</div>
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">: {{ $data['kamar']->pendingin_ruangan }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">Televisi </div>
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">: {{ $data['kamar']->tv }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">Kamar Mandi </div>
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">: {{ $data['kamar']->kamar_mandi }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">Peralatan Mandi </div>
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">: {{ $data['kamar']->peralatan_mandi }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">Breakfast </div>
                                            <div class="col-sm-6 d-flex justify-content-start fw-medium">: {{ $data['kamar']->breakfast }}</div>
                                        </div>
                                    </div>
                                    <hr>
                                    @if( $data['rata_rating']==5)
                                        @include('layouts.star.ratings-5')

                                    @elseif($data['rata_rating']==4.5)
                                        @include('layouts.star.ratings-45')

                                    @elseif($data['rata_rating']==4)
                                        @include('layouts.star.ratings-4')

                                    @elseif($data['rata_rating']==3.5)
                                        @include('layouts.star.ratings-35')

                                    @elseif($data['rata_rating']==3)
                                        @include('layouts.star.ratings-3')

                                    @elseif($data['rata_rating']==2.5)
                                        @include('layouts.star.ratings-25')

                                    @elseif($data['rata_rating']==2.0)
                                        @include('layouts.star.ratings-2')

                                    @elseif($data['rata_rating']==1.5)
                                        @include('layouts.star.ratings-15')

                                    @elseif($data['rata_rating']==1.0)
                                        @include('layouts.star.ratings-1')

                                    @elseif($data['rata_rating']==0.5)
                                        @include('layouts.star.ratings-5')
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>


   <!-- Footer -->
    @include('layouts.footer')

     <!-- Bootstrap JS and Popper.js -->
     <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lamaNginapInput = document.getElementById('lama_inap');
            const jumlahKamarInput = document.getElementById('jumlah_kamar');
            const totalHargaInput = document.getElementById('total_harga');
            const hargaPerMalam = parseInt(totalHargaInput.value) / parseInt(lamaNginapInput.value);

            function hitungTotal_Harga() {
                const lamaNginap = parseInt(lamaNginapInput.value) || 0;
                const jumlahKamar = parseInt(jumlahKamarInput.value) || 0;
                const totalHarga = (lamaNginap * hargaPerMalam) * jumlahKamar;
                totalHargaInput.value = totalHarga;
            }

            lamaNginapInput.addEventListener('input', hitungTotal_Harga);
            jumlahKamarInput.addEventListener('input', hitungTotal_Harga);

            // Inisialisasi total harga saat halaman dimuat
            hitungTotal_Harga();
        });
   </script>

     {{-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
  </body>
</html>
