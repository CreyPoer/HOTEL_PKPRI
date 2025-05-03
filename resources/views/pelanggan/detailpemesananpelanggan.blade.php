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
        .pilihrek {
            /* width: 22rem; */
            background-color: white;
            border: 2px solid black;
            border-radius: 20px;
        }

        .pilihrek:hover {
            background-color: black;
            border: 2px solid white;
            border-radius: 20px;
            color: white;
        }
    </style>
</head>

<body>
    {{-- navbar --}}
    @include('layouts.nav')


    <!-- Konten utama -->
    <div class="container-fluid">
        <div class="container text-center bg-dark rounded-top-5 mt-4 p-3">
            <h2 class="text-white">DETAIL PEMESANAN KAMAR</h2>
        </div>
        <div class="container mt-2">
            <h3 class="text-center">Kamar Pesanan Anda</h3>
            <div class="row">
                <div class="col-md-6 row g-2">
                    <div class="card mt-3 px-0" style="background-color: #343a40;">
                        <img src="{{ asset('gambar-kamar/'.$PesananAnda->kamar['image'])}}" class="card-img-top" alt=""  width="10rem" height="300rem">
                        <div class="card-body">
                            <h3 class="card-title bg-light text-black text-center">{{ $PesananAnda->kamar['jenis_kamar'] }}</h3>
                            <div class="card-text text-light text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fw-bold">
                                            Tanggal Check-In
                                        </div>
                                        <div class="mt-1">
                                            {{ $checkin }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bold">
                                            Tanggal Check-Out
                                        </div>
                                        <div class="mt-1">
                                            {{ $checkout }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fw-bold">
                                            Tanggal Pesan
                                        </div>
                                        <div class="mt-1">
                                            {{$tglpesan }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bold">
                                            Lama Menginap
                                        </div>
                                        <div class="mt-1">
                                            {{ $PesananAnda->lama_inap }} Hari
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fw-bold">
                                            Jumlah Kamar
                                        </div>
                                        <div class="mt-1">
                                            {{ $PesananAnda->jumlah_kamar }} Kamar
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bold">
                                            Status Pemesanan
                                        </div>
                                        <div class="mt-1">
                                            {{ $PesananAnda->status_pesan }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fw-bold">
                                            Total Tagihan
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bold">
                                            {{ 'Rp.' . number_format($PesananAnda->total_harga , 2, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="color: white;">

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h5 class="accordion-header" id="headingOne">
                                        <button type="submit" class="btn btn-outline-light text-black fw-bold w-100" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                            aria-expanded="false" aria-controls="collapseOne">
                                            Fasilitas
                                        </button>
                                    </h5>
                                    @foreach($dtKamar as $data)
                                    <div id="collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body" style="background-color:black;">
                                            <div class="d-flex flex-column text-white">
                                                <div class="row row-cols-3 text-start ">
                                                    <div class="col-lg-5 fw-medium">Kapasitas </div>
                                                    <div class="col-sm-1 text-right fw-medium">:</div>
                                                    <div class="col-lg-6 px-0 mx-0 fw-medium">{{ $data['kamar']->kapasitas }} Orang</div>
                                                </div>
                                                <div class="row row-cols-3 text-start">
                                                    <div class="col-lg-5 fw-medium">Pendingin</div>
                                                    <div class="col-lg-1 text-right fw-medium">:</div>
                                                    <div class="col-lg-6 px-0 mx-0 fw-medium">{{ $data['kamar']->pendingin_ruangan }}</div>
                                                </div>
                                                <div class="row row-cols-3 text-start">
                                                    <div class="col-lg-5 fw-medium">Televisi </div>
                                                    <div class="col-lg-1 text-right fw-medium">:</div>
                                                    <div class="col-lg-6 px-0 mx-0 fw-medium">{{ $data['kamar']->tv }}</div>
                                                </div>
                                                <div class="row row-cols-3 text-start">
                                                    <div class="col-lg-5 fw-medium">Kamar Mandi </div>
                                                    <div class="col-lg-1 text-right fw-medium">:</div>
                                                    <div class="col-lg-6 px-0 mx-0 fw-medium">{{ $data['kamar']->kamar_mandi }}</div>
                                                </div>
                                                <div class="row row-cols-3 text-start">
                                                    <div class="col-lg-5 fw-medium">Peralatan Mandi</div>
                                                    <div class="col-lg-1 text-right fw-medium">:</div>
                                                    <div class="col-lg-6 px-0 mx-0 fw-medium">{{ $data['kamar']->peralatan_mandi }}</div>
                                                </div>
                                                <div class="row row-cols-3 text-start">
                                                    <div class="col-lg-5 fw-medium">Breakfast</div>
                                                    <div class="col-lg-1 text-right fw-medium">:</div>
                                                    <div class="col-lg-6 px-0 mx-0 fw-medium">{{ $data['kamar']->breakfast }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if( $rataRating==5 || $rataRating==null)
                            @include('layouts.bintang.ratings-5')
                        @elseif($rataRating>=4.5 && $rataRating<5)
                            @include('layouts.bintang.ratings-45')
                        @elseif($rataRating>=4 && $rataRating<4.5)
                            @include('layouts.bintang.ratings-4')
                        @elseif($rataRating>=3.5 && $rataRating<4)
                            @include('layouts.bintang.ratings-35')
                        @elseif($rataRating>=3 && $rataRating<3.5)
                            @include('layouts.bintang.ratings-3')
                        @elseif($rataRating>=2.5 && $rataRating<3)
                            @include('layouts.bintang.ratings-25')
                        @elseif($rataRating>=2 && $rataRating<2.5)
                            @include('layouts.bintang.ratings-2')
                        @elseif($rataRating>=1.5 && $rataRating<2)
                            @include('layouts.bintang.ratings-15')
                        @elseif($rataRating>=1 && $rataRating<1.5)
                            @include('layouts.bintang.ratings-1')
                        @elseif($rataRating>=0 && $rataRating<1)
                            @include('layouts.bintang.ratings-05')
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6">
                    @if($status==0)
                    <h3 class="text-center pt-4 mt-0">Metode Pembayaran</h3>
                    <p class="text-center fw-medium">Silahkan Pilih Metode Pembayaran yang telah kami sediakan untuk melakukan pembayaran :</p>
                    <div class="row gap-3">
                        <div class="col-md-12">
                            <a class="btn btn-dark btn-lg" data-bs-toggle="modal"
                                data-bs-target="#OFFLINE">
                                <div class="text-center text-light py-2 border-bottom border-5 border-black">
                                    <h5 class="fw-semibold">Pembayaran Offline</h5>
                                </div>
                                <div class="row py-1">
                                    <div class="col-md-3 mx-1 px-0">
                                        <div class="pt-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="img-fluid" fill="white" class="bi bi-building" viewBox="0 0 16 16">
                                                <path
                                                    d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                                                <path
                                                    d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mx-1 row g-2">
                                        <h5 class="fw-medium text-start">Silahkan Bayar Di Resepsionis Hotel Kami</h5>
                                        <div class="fs-6 text-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff"
                                                class="bi bi-pin-map" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z" />
                                                <path fill-rule="evenodd"
                                                    d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
                                            </svg>
                                            Jalan.Panglima Sudirman No.122A, Lebak, Pejagan, Kec.Bangkalan, Kabupaten
                                            Bangkalan, Jawa Timur 69112
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="modal fade" id="OFFLINE" tabindex="-1" aria-labelledby="examplemodaloffline"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content bg-dark text-light" style="border-radius: 20px 20px 0px 0px;">
                                        <div class="modal-header" style="border-radius: 20px 20px 0px 0px;">
                                            <h5 class="modal-title" id="examplemodaloffline">KONFIRMASI PEMBAYARAN</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <h6>Terdapat Ketentuan dari kami terkait pembayaran secara offline untuk
                                                    pemesanan kamar Anda, Harap disimak dengan baik.</h6>
                                            </div>
                                            <div class="row ps-4 alert alert-warning pt-3" role="alert">
                                                <ul>
                                                    <li>
                                                        <h6>Setelah memilih pembayaran secara offline akan diberikan
                                                                waktu selama 1 x 24 Jam dari sejak anda menekan tombol
                                                                Setuju dibawah</h6>
                                                    </li>
                                                    <li>
                                                        <h6>Pembayaran offline secara langsung dilakukan di resepsionis
                                                                kami </h6>
                                                    </li>
                                                    <li>
                                                        <h6>Pembayaran offline secara langsung dilakukan selama sebelum
                                                                mencapai hari selanjutnya (24 Jam)</h6>
                                                    </li>
                                                    <li>
                                                        <h6>Jika Anda belum melakukan pembayaran secara langsung setelah
                                                                waktu yang di berikan (1 x 24 jam), Maka peseanan anda
                                                                secara otomatis akan dihapus dari daftar pesanan anda
                                                        </h6>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="row">
                                                <h6>Setelah mengetahui ketentuan diatas, Apakah Anda setuju untuk melakukan
                                                    pembayaran terkait pemesanan anda secara langsung ? </h6>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="border-radius: 0px 0px 20px 20px;">
                                            <form action="/bayaronlinepelanggan/{{ $id_pemesanan }}" method="post">
                                                @csrf
                                                <input type="hidden" class="form-control" name="metode_pembayaran"
                                                    value="OFFLINE">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-light">Setuju</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="background-color: #343a40;">
                                <div class="card-body">
                                    <div class="text-center text-light py-2 border-bottom border-5 border-black">
                                        <h5 class="fw-semibold">Pembayaran Online</h5>
                                    </div>
                                    <div class="text-center text-light py-2">
                                        <h5>Silahkan Pilih Bank Yang Tersedia</h5>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="img-fluid" fill="white" class="bi bi-credit-card-2-front"viewBox="0 0 16 16">
                                                <path
                                                    d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
                                                <path
                                                    d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                                            </svg>
                                        </div>
                                        <div class="col-md-8 g-3 ps-4">
                                            @foreach($rekening as $rek)
                                            <div class="row">
                                                <button class="col-md-12 pilihrek" data-bs-toggle="modal"
                                                    data-bs-target="#{{ str_replace(' ', '_', $rek->rek_tujuan) }}">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <h6><b>{{ $rek->rek_tujuan }}</b></h6>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h6>Nomer Rekening : {{ $rek->no_rek_tujuan }}</h6>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h6>Atas Nama : {{ $rek->atas_nama }}</h6>
                                                        </div>
                                                    </div>
                                                </button>
                                                <div class="modal fade" id="{{ str_replace(' ', '_', $rek->rek_tujuan) }}" tabindex="-1" aria-labelledby="examplemodalonline" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content" style="background-color:#ededed;border-radius: 20px 20px 0px 0px;">
                                                        <div class="modal-header" style="border-radius: 20px 20px 0px 0px;">
                                                            <h5 class="modal-title" id="examplemodalonline">Konfirmasi Pembayaran</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body bg-dark" style="color:#ededed;">
                                                        <form action="/bayaronlinepelanggan/{{ $id_pemesanan }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                        <div class="mb-3 row">
                                                            <label class="col-sm-5 col-form-label">Total Yang Harus Dibayar</label>
                                                            <div class="col-sm-7">
                                                                <h5>
                                                                    <input type="text" readonly class="form-control-plaintext"  value=": {{ 'Rp.' . number_format($PesananAnda->total_harga , 2, ',', '.') }}" style="color:#ededed;">
                                                                </h5>
                                                                <input type="hidden" readonly class="form-control-plaintext" id="totalHargaHidden" value="{{ $PesananAnda->total_harga }}">
                                                            <input type="hidden" readonly class="form-control-plaintext"  value="">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label class="col-sm-5 col-form-label">Jika DP Total bayar</label>
                                                            <div class="col-sm-7">
                                                                <h5>
                                                                    <input type="text" readonly class="form-control-plaintext"  value=": {{ 'Rp.' . number_format(($PesananAnda->total_harga*50)/100 , 2, ',', '.') }}" style="color:#ededed;">
                                                                </h5>
                                                                <input type="hidden" readonly class="form-control-plaintext" id="totalBayarDPHidden" value="{{ ($PesananAnda->total_harga * 50) / 100 }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="inputdate" class="col-sm-5 col-form-label">Tanggal Pembayaran</label>
                                                            <div class="col-sm-7">
                                                            <input type="date" class="form-control" id="inputdate" name="tgl_bayar" value="{{ $tanggalHariIni }}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="" class="col-sm-5">Jenis Bayar</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-select text-dark" name="bayar" aria-label="Default select example">
                                                                    <option value="FULL" selected>FULL</option>
                                                                    <option value="DP">DP</option>
                                                                    </select>
                                                                @error('bayar')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="inputrekasal" class="col-sm-5 col-form-label" data-bs-toggle="tooltip" data-bs-placement="left" title="Nama Bank Yang Anda Gunakan">Rekening Anda</label>
                                                            <div class="col-sm-7">
                                                            <input type="text" class="form-control" id="inputrekasal" name="rek_asal">
                                                            <input type="hidden" name="jumlah_pembayaran" class="form-control" id="inputjumlahpembayaran" value="{{ $PesananAnda->total_harga }}">
                                                            @error('rek_asal')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="inputnorekasal" class="col-sm-5 col-form-label" data-bs-toggle="tooltip" data-bs-placement="left" title="Nomer Rekening Bank Yang Anda Gunakan">No.Rekening Anda</label>
                                                            <div class="col-sm-7">
                                                            <input type="text" class="form-control" id="inputnorekasal" name="no_rek_asal">
                                                            @error('no_rek_asal')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="inputnamarekasal" class="col-sm-5 col-form-label" data-bs-toggle="tooltip" data-bs-placement="left" title="Atas nama yang tertera di Bank Yang Anda Gunakan">Atas Nama</label>
                                                            <div class="col-sm-7">
                                                            <input type="text" class="form-control" id="inputnamarekasal" name="atas_nama">
                                                            @error('atas_nama')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="inputrektujuan" class="col-sm-5 col-form-label">Rekening Tujuan</label>
                                                            <div class="col-sm-7">
                                                            <input type="text" class="form-control" name="rek_tujuan" id="inputrektujuan" value="{{  $rek->rek_tujuan  }}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="inputnorektujuan" class="col-sm-5 col-form-label">No.Rekening Tujuan</label>
                                                            <div class="col-sm-7">
                                                            <input type="text" class="form-control" name="no_rek_tujuan" id="inputnorektujuan" value="{{  $rek->no_rek_tujuan  }}" readonly>
                                                            <input type="hidden" class="form-control" name="rekening_id" value="{{  $rek->id  }}">
                                                            <input type="hidden" class="form-control" name="metode_pembayaran" value="ONLINE">
                                                            </div>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label for="inputjumlahpembayaran" class="col-sm-5 col-form-label">Bukti Pembayaran</label>
                                                            <div class="col-sm-7">
                                                                <div class="input-group">
                                                                    <input type="file" name="bukti_transfer" class="form-control" id="inputGroupFile02">
                                                                    <label class="input-group-text" name="bukti_transfer" for="inputGroupFile02">Upload</label>
                                                                </div>
                                                                @error('bukti_transfer')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="modal-footer" style="background-color: #ededed;border-radius: 0px 0px 20px 20px;">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-dark">Konfirmasi</button>
                                                        </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($status==1)
                    <div class="alert alert-primary mt-4" role="alert" style="text-align: center;">
                        <h1>TERIMA KASIH </h1><br>
                        <h6>Terima kasih telah melakukan Pembayaran terkait pemesanan anda</h6><br>
                        <img src="{{ asset('video/hourglass.gif') }}" alt="GIF Image" width="320" height="400"><br>
                        <h6 class="indented-paragraph">Pembayaran yang telah anda lakukan, selanjutnya akan kami validasi dan segera akan kami
                            konfirmasi bahwasannya pembayaran anda telah diterima atau tidak oleh pihak kami</h6><br>
                        <h6><b>Kami mohon kesediaan untuk menunggu proses validasi pembayaran anda </b></h6><br>
                        <a type="button" href="/pesananpelanggan/{{ $pelanggan_id }}" class="btn btn-primary"
                            style="width:100%"><b>Kembali</b></a>

                    </div>
                    @elseif($status==2)
                    <div class="alert alert-success mt-4" role="alert" style="text-align: center;">
                        <h1>SILAHKAN CHECK IN </h1><br>
                        <h6 class="indented-paragraph">Pembayaran anda telah kami validasi dan konfirmasi terkait pemesanan kamar anda</h6><br>
                        <img src="{{ asset('video/verified-file.gif') }}" alt="GIF Image" width="220" height="300"><br>
                        <h6 class="text-start">Pembayaran yang telah anda lakukan, telah kami terima dengan baik dan telah kami konfirmasi
                            terkait pembayaran anda. Selanjutnya anda dapat langsung menuju Resepisonis kami untuk melakukan
                            Check In kamar pada tanggal <b>{{ $checkin }}</b>.</h6><br>
                        <h6 style="text-align: start;">Adapun hal-hal yang perlu diperhatikan, saat anda ingin melakukan
                            Check In seperti berikut:</h6>
                        <ul style="text-align: start;">
                            <li><b>Anda Hanya dapat Check In, setelah jam menunjukkan pukul 13.00 WIB atau setelahnya.</b>
                            </li>
                            <li><b>Perlu diingat, Check In sebelum jam 13.00 WIB akan dikenakan tambahan tarif</b></li>
                            <li><b>Perlu diingat, Check In setelah jam 24.00 WIB tetap terhitung semalam s/d jam 12.00
                                    WIB</b></li>
                            <li><b>Bagi suami istri atau Laki-laki Perempuan Wajib menunjukkan KTP yang sama alamatnya.</b>
                            </li>
                            <li><b>Tamu Wisma dilarang membawa senjata tajam, minum-minuman keras, berjudi & berbuat
                                    asusila.</b></li>
                        </ul>
                        <a type="button" href="/pesananpelanggan/{{ $pelanggan_id }}" class="btn btn-success"
                            style="width:100%"><b>Kembali</b></a>

                    </div>
                    @elseif($status==3)
                    <div class="alert alert-warning mt-4" role="alert" style="text-align: center;">
                        <h1>ANDA SEDANG CHECK IN </h1><br>
                        <h6>Saat ini telah melakukan Check In dengan baik ke kamar pesanan anda tanpa ada masalah</h6><br>
                        <img src="{{ asset('video/check-in.gif') }}" alt="GIF Image" width="220" height="300"><br>
                        <h6>Anda telah melakukan Check In kamar. Silahkan nikmati fasilitas yang telah kami sediakan dana
                            yang tertera pada detail pemesanan anda di samping ini.</h6><br>
                        <h6>Selamat menikmati fasilitas kamar yang telah kami tawarkan. Semoga fasilitas kamar yang kami
                            sediakan dapat berkesan pada anda dana membuat anda nyaman</h6><br>
                        <h6 style="text-align: start;">Adapun hal-hal yang perlu diperhatikan, saat anda ingin melakukan
                            Check Out seperti berikut:</h6>
                        <ul style="text-align: start;">
                            <li><b>Anda dapat Check Out pada jam 12.00 WIB atau sebelumnya.</b></li>
                            <li><b>Perlu diingat, Check Out sesudah jam 12.00 WIB s/d jam 18.00 WIB dapat dikenakan tambahan
                                    50% dari tarif.</b></li>
                            <li><b>Perlu diingat, Check Out setelah jam 18.00 WIB s/s jam 24.00WIB dikenakan tambahan 100%
                                    dari tarif.</b></li>
                            <li><b>Pembayaran tarif tambahan akan hanya dapat dilakukan secara offline di resepsionis
                                    kami.</b></li>
                        </ul>
                        <a type="button" href="/pesananpelanggan/{{ $pelanggan_id }}" class="btn btn-warning"
                            style="width:100%"><b>Kembali</b></a>

                    </div>
                    @elseif($status==4)
                    <div class="alert alert-success mt-4" role="alert" style="text-align: center;color:black;">
                        <h1>ANDA SUDAH CHECK OUT</h1><br>
                        <h6>Saat ini anda telah melakukan check out di resepsionis kami dengan baik.</h6><br>
                        <img src="{{ asset('video/hotel.gif') }}" alt="GIF Image" width="220" height="300"><br>
                        <h6>Kami selaku penyedia layanan mengucapkan banyak-banyak terima kasih telah memberikan kesempatan
                            terhadap kami untuk dapat melayani anda dengan fasilitas-fasilitas kamar yang telah kami
                            tawarkan.</h6><br>
                        <h6>Kami segenap penyedia penginapan ingin mengucapkan minta maaf apabila terdapat pelayanan kami
                            yang kurang berkenan di hati anda. Kami segenap penyedia penginapan mohon maaf yang
                            sebesar-besarnya.</h6><br>
                        <h6>Untuk menudukung pelayanan yang lebih baik, kami memohon pada anda untuk dapat memberikan ulasan
                            terkait kamar yang telah anda pesanan. Demi perubahan yang lebih baik dan sempurna kedepannya.
                        </h6><br>
                        <button class="btn btn-info" data-bs-toggle="modal" style="width:100%"
                            data-bs-target="#UlasanAnda"><b>Ulasan Anda</b></button>

                        <div class="modal fade" id="UlasanAnda" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" style="background-color:#ededed;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ULASAN TENTANG JENIS KAMAR YANG ANDA
                                            PESAN</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="background-color: black;color:#ededed;">
                                        <div class="row p-2">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <h6><b>Kamar {{ $namakamar }}</b></h6>
                                                </div>
                                                <div class="row">
                                                    <img src="{{ asset('images/kamarekonomi.jpg') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <h6><b>Formulir Ulasan </b></h6>
                                                </div>
                                                <div class="row">
                                                    <form method="post" action="/testimonipelanggan">
                                                        @csrf
                                                        <div class="mb-3 text-start">
                                                            <div class="row">
                                                                <label for="exampleInputRating"
                                                                    class="form-label">Rating</label>
                                                                <input type="hidden" class="form-control"
                                                                    name="pelanggan_id" value="{{  $pelanggan_id  }}">
                                                                <input type="hidden" class="form-control" name="kamar_id"
                                                                    value="{{  $cariidkamar  }}">
                                                                <input type="hidden" class="form-control"
                                                                    name="id_pemesanan" value="{{  $id_pemesanan  }}">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="inlineRadioOptions" id="inlineRadio1"
                                                                            value=1.0>
                                                                        <label class="form-check-label"
                                                                            for="inlineRadio1">1</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="inlineRadioOptions" id="inlineRadio2"
                                                                            value=2.0>
                                                                        <label class="form-check-label"
                                                                            for="inlineRadio2">2</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="inlineRadioOptions" id="inlineRadio2"
                                                                            value=3.0>
                                                                        <label class="form-check-label"
                                                                            for="inlineRadio2">3</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="inlineRadioOptions" id="inlineRadio2"
                                                                            value=4.0>
                                                                        <label class="form-check-label"
                                                                            for="inlineRadio2">4</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="inlineRadioOptions" id="inlineRadio2"
                                                                            value=5.0>
                                                                        <label class="form-check-label"
                                                                            for="inlineRadio2">5</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 text-start">
                                                            <label for="exampleInputUlasan"
                                                                class="form-label">Ulasan</label>
                                                            <textarea class="form-control" id="exampleInputUlasan"
                                                                name="ulasan" rows="3"></textarea>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer"
                                        style="background-color:#ededed;">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-dark">Kirim</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($status==5)
                    <div class="alert alert-success mt-4" role="alert" style="text-align: center;color:black;">
                        <h3>TERIMA KASIH ATAS KUNJUNGAN ANDA</h3><br>
                        <h6>Terima Kasih Anda telah melakukan pemesanan kamar di HOTEL PKPRI ini Saat ini anda telah
                            melakukan check out di resepsionis kami dengan baik.</h6><br>
                        <img src="{{ asset('video/hotel.gif') }}" alt="GIF Image" width="220" height="300"><br>
                        <h6>Kami selaku penyedia layanan mengucapkan banyak-banyak terima kasih telah memberikan kesempatan
                            terhadap kami untuk dapat melayani anda dengan fasilitas-fasilitas kamar yang telah kami
                            tawarkan.</h6><br>
                        <h6>Kami segenap penyedia penginapan ingin mengucapkan minta maaf apabila terdapat pelayanan kami
                            yang kurang berkenan di hati anda. Kami segenap penyedia penginapan mohon maaf yang
                            sebesar-besarnya.</h6><br>
                        <h6>Kami Ucapkan Banyak terima kasih terkait masukan anda terkait jenis kamar yang anda pesan di
                            HOTEL PKPRI ini</h6><br>
                        <a type="button" href="/pesananpelanggan/{{ $pelanggan_id }}" class="btn btn-info"
                            style="width:100%"><b>Kembali</b></a>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Footer -->
        @include('layouts.footer')

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

        {{-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                var radioButtons = document.querySelectorAll('input[name="bayar"]');
                var inputJumlahPembayaran = document.getElementById('inputjumlahpembayaran');
                var totalHargaHidden = parseFloat(document.getElementById('totalHargaHidden').value);
                var totalBayarDPHidden = parseFloat(document.getElementById('totalBayarDPHidden').value);

                function setJumlahPembayaran(jenisBayar) {
                    if (jenisBayar === 'DP') {
                        inputJumlahPembayaran.value = totalBayarDPHidden.toFixed(2);
                    } else if (jenisBayar === 'FULL') {
                        inputJumlahPembayaran.value = totalHargaHidden.toFixed(2);
                    }
                }

                // Inisialisasi nilai saat halaman dimuat
                setJumlahPembayaran(document.querySelector('input[name="bayar"]:checked').value);

                // Tambahkan event listener pada setiap radio button
                radioButtons.forEach(function(radioButton) {
                    radioButton.addEventListener('change', function() {
                        setJumlahPembayaran(this.value);
                    });
                });
            });
        </script> --}}

</body>

</html>
