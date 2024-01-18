<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Pemesanan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
  <style>
    .nav-pills {
    height: 100vh; /* 100% tinggi dari viewport */
    overflow-y: auto; /* Memberikan scroll jika konten lebih panjang dari tinggi viewport */
  }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('images/LOGO_PKPRI.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Main Sidebar Container -->
    @include('admin.layout.sidebar')>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header    ) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Antrian</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Pemesanan</h3>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-black text-white">
                                Detail Pemesanan Pelanggan
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="card col-auto">
                                            <div class="zoom-effect">
                                                <img src="{{ asset('storage/image-kamar/'.$Pemesanan->kamar->image)}}" class="card-img-top" alt="...">
                                            </div>
                                            <div class="card-body bg-tan text-center   ">
                                                <h3 class="card-title text-center" style="color:black;background:#ededed;width:100%;"><b>{{ $Pemesanan->kamar->jenis }}</b></h3>
                                                <div class="card-text" style="color: black;">
                                                <div class="row maindetailpemesanan">
                                                    <div class="row">
                                                        <h6>Jenis Kamar</h6>
                                                    </div>
                                                    <div class="row pb-3">
                                                        <h5><b>{{ $Pemesanan->kamar->jenis_kamar }}</b></h5>
                                                    </div>
                                                </div>
                                                <div class="row maindetailpemesanan">
                                                    <div class="col-md-6 detailpemesanan">
                                                        <div><b><p>Tanggal Check-In</p></b></div>
                                                        <div style="margin-top: -1rem;"><p>{{ $Pemesanan->check_in }}</b></div>
                                                    </div>
                                                    <div class="col-md-6 detailpemesanan">
                                                        <div><b><p>Tanggal Check-Out</p></b></div>
                                                        <div style="margin-top: -1rem;"><p>{{ $Pemesanan->check_out }}</p></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row maindetailpemesanan">
                                                    <div class="col-md-6 detailpemesanan" style="margin-top: -1rem;">
                                                        <div><b><p>Tanggal Pesan</p></b></div>
                                                        <div style="margin-top: -1rem;"><p>{{ $Pemesanan->tgl_pesan }}</p></div>
                                                    </div>
                                                    <div class="col-md-6 detailpemesanan" style="margin-top: -1rem;">
                                                        <div><b><p>Lama Menginap</p></b></div>
                                                        <div style="margin-top: -1rem;"><p>{{ $Pemesanan->lama_inap }} Hari</p></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row maindetailpemesanan">
                                                    <div class="col-md-6 detailpemesanan" style="margin-top: -1rem;">
                                                        <div><b><p>Jumlah Kamar</p></b></div>
                                                        <div style="margin-top: -1rem;"><p>{{ $Pemesanan->jumlah_kamar }} Kamar</p></div>
                                                    </div>
                                                    <div class="col-md-6 detailpemesanan" style="margin-top: -1rem;">
                                                        <div><b><p>Status Pemesanan</p></b></div>
                                                        <div style="margin-top: -1rem;"><p>{{ $Pemesanan->status_pesan }}</p></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row maindetailpemesanan">
                                                    <div class="col-md-6 detailpemesanan" style="margin-top: -1rem;">
                                                        <div><b><p>Status Check-In</p></b></div>
                                                        <div style="margin-top: -1rem;"><p>{{ $Pemesanan->status_checkin }}</p></div>
                                                    </div>
                                                    <div class="col-md-6 detailpemesanan" style="margin-top: -1rem;">
                                                        <div><b><p>Status Ulasan Kamar</p></b></div>
                                                        <div style="margin-top: -1rem;"><p>{{ $Pemesanan->status_ulasan }}</p></div>
                                                    </div>
                                                </div>
                                            </div>
                                                <hr style="color: black;">
                                            <div>

                                            </div>
                                            <div class="accordion" id="accordionExample">
                                            <div class="accordion-item" >
                                                <h5 class="accordion-header" id="headingOne" >
                                                <button style="background-color:#ededed;width:100%;color:black;margin-left:-0.15rem;border:3px solid black;" class="accordion-button-color collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" collapsed>
                                                    <b>Fasilitas</b>
                                                </button>
                                            </h5>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body" style="background-color:#ededed;color:#black;">
                                                <div class="macamfasilitas">
                                                    <div class="fasilitas row">
                                                            <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Kapasitas </b></h6></div>
                                                            <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $Pemesanan->kamar->kapasitas }} Orang</b></h6></div>
                                                    </div>
                                                    <div class="fasilitas row">
                                                            <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Bed</b></h6></div>
                                                            <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $Pemesanan->kamar->bed }}</b></h6></div>
                                                    </div>
                                                    <div class="fasilitas row">
                                                            <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Pendingin</b> </h6></div>
                                                            <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $Pemesanan->kamar->pendingin_ruangan }}</b></h6></div>
                                                    </div>
                                                    <div class="fasilitas row">
                                                            <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Televisi</b> </h6></div>
                                                            <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $Pemesanan->kamar->tv }}</b></h6></div>
                                                    </div>
                                                    <div class="fasilitas row">
                                                            <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Kamar Mandi</b> </h6></div>
                                                            <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $Pemesanan->kamar->kamar_mandi }}</b></h6></div>
                                                    </div>
                                                    <div class="fasilitas row">
                                                            <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Peralatan Mandi </b></h6></div>
                                                            <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $Pemesanan->kamar->peralatan_mandi }}</b></h6></div>
                                                    </div>
                                                    <div class="fasilitas row">
                                                            <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Breakfast</b> </h6></div>
                                                            <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $Pemesanan->kamar->breakfast }}</b></h6></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                            </div>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="width: 32.5rem;">
                                <div class="card-header bg-black">
                                Validasi Pembayaran Pelanggan
                                </div>
                                <div class="card-body">
                                    <div class="detailpemesanan2 text-center">
                                        <div><b><h6>Total Tagihan</h6></b></div>
                                        <div><b><h3>{{ 'Rp.' . number_format($Pemesanan->total_harga , 2, ',', '.') }}</h3></b></div>
                                    </div>
                                    <form>
                                        @foreach ($Pemesanan->pembayaran as $pembayaran)
                                        @if($pembayaran->metode_pembayaran=="ONLINE")
                                        <div class="row">
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Tanggal Bayar</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  {{ $pembayaran->tgl_bayar }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Metode Pembayaran</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  {{ $pembayaran->metode_pembayaran }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Rekening Tujuan</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  {{ $pembayaran->rek_tujuan }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Nomer Rekening Tujuan</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  {{ $pembayaran->no_rek_tujuan }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Rekening Asal</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  {{ $pembayaran->rek_asal }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">No Rekening Asal</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  {{ $pembayaran->no_rek_asal }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Atas Nama</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  {{ $pembayaran->atas_nama }}</label>
                                                </div>
                                            </div>
                                            @if($pembayaran->jumlah_dp==0)
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Jumlah Yang Dibayar</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  Rp.{{  $pembayaran->jumlah_pembayaran}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 pt-2">
                                            <p>
                                                <a class="btn btn-outline-secondary" style="width:100%;" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Lihat Bukti Pembayaran
                                                </a>
                                            </p>
                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body">
                                                    <img src="{{ asset('storage/image-buktitransfer/'.$pembayaran->bukti_transfer)}}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                            @else
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Jumlah Bayar DP</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  Rp.{{  $pembayaran->jumlah_dp}}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 pt-2">
                                            <p>
                                                <a class="btn btn-outline-dark" style="width:100%;" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Lihat Bukti Pembayaran
                                                </a>
                                            </p>
                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body">
                                                    <img src="{{ asset('storage/image-buktitransfer/'.$pembayaran->bukti_transfer)}}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                            @endif
                                        @else
                                        <div class="row">
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Tenggat Konfirmasi</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  {{ $Pemesanan->tenggat_bayar }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Tanggal Bayar</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  {{ $pembayaran->tgl_bayar }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Metode Pembayaran</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  {{ $pembayaran->metode_pembayaran }}</label>
                                                </div>
                                            </div>
                                            @if($pembayaran->jumlah_dp==0)
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label">Jumlah Bayar Full</label>
                                                <div class="col-sm-7 pt-2">
                                                <label for="col-form-label">:  Rp.{{  $pembayaran->jumlah_pembayaran}}</label>
                                                </div>
                                            </div>
                                                @else
                                                <div class="row">
                                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Jumlah Bayar DP</label>
                                                    <div class="col-sm-7 pt-2">
                                                    <label for="col-form-label">:  Rp.{{  $pembayaran->jumlah_dp}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                                @endif
                                                <div class="detailpemesanan2 text-center pt-3">
                                                    <div><b><h6>Status Pembayaran</h6></b></div>
                                                    <div><b><h3>{{ $Pemesanan->status_pembayaran}}</h3></b></div>
                                                </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="card-footer text-right">
                                        @if($metode_pembayaran == "OFFLINE" && $status_pembayaran == "Menunggu Konfirmasi")
                                        <a type="button" href="/konfirmasibayarofflineadmin" class="btn btn-success">Validasi Pembayaran</a>
                                        @elseif($metode_pembayaran == "ONLINE" && $status_pembayaran == "Menunggu Konfirmasi")
                                        <a type="button" href="{{ route('konfirmasibayar') }}" class="btn btn-success">Validasi Pembayaran</a>
                                        @elseif($status_pesan == "Aktif" && ($status_pembayaran == "Sudah Bayar" || $status_pembayaran == "Masih DP") && $status_checkin == "Belum Check-In")
                                        <a type="button" href="/lihatpemesananaktifadmin" class="btn btn-success">Pelanggan Belum Check-In</a>
                                        @elseif($status_pesan == "Aktif" && ($status_pembayaran == "Sudah Bayar" || $status_pembayaran == "Masih DP") && $status_checkin == "Sedang Check-In")
                                        <a type="button" href="{{ route('lihatpelanggancheckinadmin') }}" class="btn btn-success">Pelanggan Sedang Check-In</a>
                                        @elseif($status_pesan == "Sudah Aktif" && ($status_pembayaran == "Sudah Bayar" || $status_pembayaran == "Masih DP") && $status_checkin == "Sudah Check-Out")
                                        <a type="button" href="{{ route('laporanadmin') }}" class="btn btn-success">Laporan</a>
                                        @endif
                                        <a type="button" href="{{ route('lihatpemesananadmin') }}" class="btn btn-danger">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        <!-- Default box -->
        <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('admin.layout.footer')>


</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('lte/dist/js/demo.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
        });
</script>

</body>
