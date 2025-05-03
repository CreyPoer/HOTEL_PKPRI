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
    <!-- Konten utama -->
    <section class="container-fluid">
        <div class="container mt-3">
            <h1 class="text-center">PEMESANAN KAMAR ANDA</h1>
            <div class="container m-0 p-0  table-responsive-lg">
                @if (session()->has('succespesan'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('succespesan') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif (session()->has('berhasilbayaronline'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('berhasilbayaronline') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif (session()->has('berhasilbayaroffline'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('berhasilbayaroffline') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif (session()->has('berhasilmengulas'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('berhasilmengulas') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif (session()->has('berhasilmenghapus'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('berhasilmenghapus') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="row pt-4">
                    <div class="col-md-6 text-start">
                        <h6><b>Tanggal Hari Ini : {{ \Carbon\Carbon::parse($tanggalHariIni)->format('d F Y') }}</b></h6>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"">
                            <h6><b>Informasi dan Ketentuan</b></h6>
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Informasi dan Ketentuan</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Terdapat ketentuan yang perlu diperhatikan
                          <ul class="list-group">
                            <li class="list-group-item bg-dark text-light">Silahkan segera aktifkan pemesanan anda dengan memilih konfirmasi pembayaran, apabila status pemesanan anda <b>Belum Aktif</b> dengan menekan tombol <a href="#" class="btn btn-warning">Aktifkan</a></li>
                            <li class="list-group-item bg-dark text-light">Pesanan yang masih tidak aktif selama kurun waktu paling lambat 1 hari setelah melakukan pemesanan, maka pesanan tersebut akan <b>di hapus</b>(Silahkan dapat menghubungi Contact Person dibawah)</li>
                            <li class="list-group-item bg-dark text-light">Untuk mengaktifkan pemesanan anda akan di minta untuk konfirmasi pembayaran terkait pemesanan anda</li>
                            <li class="list-group-item bg-dark text-light">Konfirmasi pembayaran dapat dilakukan secara <b>offline</b> ataupun <b>online</b></li>
                            <li class="list-group-item bg-dark text-light">Jika memilih konfirmasi pembayaran secara <b>offline</b>, Anda diminta untuk melakukan konfirmasi sampai tanggal <b>tenggat konfirmasi bayar</b> Anda berakhir</li>
                            <li class="list-group-item bg-dark text-light">Silakan selalu pantau aktifitas pemesanan anda dengan menekan tombol <a href="#" class="btn btn-primary">Detail</a></li>
                        </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                @if($terdapat>0)
                <table class="table table-light table-bordered text-center border-dark">
                    <thead class="table-dark">
                        <tr >
                            <th scope="col">Jenis Kamar</th>
                            <th scope="col">Tanggal Pemesanan</th>
                            <th scope="col">Lama Inap</th>
                            <th scope="col">Jumlah Kamar</th>
                            <th scope="col">Tenggat Konfirmasi Bayar</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status Pemesanan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($PesananAnda as $data)
                        <tr>
                            <td>{{ $data->kamar->jenis_kamar }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tgl_pesan)->format('d F Y') }}</td>
                            <td>{{ $data->lama_inap }} hari</td>
                            <td>{{ $data->jumlah_kamar }}</td>
                            <td>
                                @if ($data->tenggat_bayar != null && $data->status_pembayaran == "Menunggu Konfirmasi")
                                {{ \Carbon\Carbon::parse($data->tenggat_bayar)->format('d F Y') }}
                                @else
                                -
                                @endif
                            </td>
                            <td>{{ $data->total_harga }}</td>
                            <td>{{ $data->status_pesan }}</td>
                            <td>
                                @if($data->status_pembayaran == "Sudah Bayar" || $data->status_pembayaran == "Menunggu Konfirmasi" || $data->status_pembayaran == "Masih DP")
                                <div class="row px-2">
                                    <a href="/lihatdetailpemesanan/{{ $data->id }}" class="btn btn-primary">Detail</a>
                                </div>
                                <div class="row px-2 p-1">
                                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#AdminHapusKonfirmasiPembayaranOffline-{{ $data->id }}">Cancel</a>
                                </div>
                                @elseif($data->status_pembayaran == "Belum Bayar")
                                <div class="row px-2">
                                    <a href="/detailkonfirmasipembayaran/{{ $data->id }}" class="btn btn-warning">Aktifkan</a>
                                </div>
                                <div class="row px-2 p-1">
                                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#AdminHapusKonfirmasiPembayaranOffline-{{ $data->id }}">Cancel</a>
                                </div>
                                @endif

                                <div class="modal fade" id="AdminHapusKonfirmasiPembayaranOffline-{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Pemesanan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/validasihapuspemesanan" method="POST">
                                            @csrf
                                        <div class="modal-body text-start">
                                            <input type="hidden" name="id_pemesanan" value="{{ $data->id }}">
                                            <div class="row"><h6>Apakah Anda Yakin ingin menghapus data pemesanan Anda ? </h6></div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Yakin</button>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="row text-center d-flex justify-content-center mt-5">
                    <div class="row" style="width:20rem;">
                        <img src="{{ asset('video/research.gif') }}" alt="GIF Image" width="220" height="300">
                    </div>
                    <div class="row">
                        <h6><b>Maaf</b>, Anda belum melakukan pemesanan kamar hotel silahkan dapat melakukan pemesanan hotel terleih dahulu</h6>
                    </div>
                </div>
                @endif
                <div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    @include('layouts.footer')

        <!-- Bootstrap JS and Popper.js -->
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

  </body>
</html>
