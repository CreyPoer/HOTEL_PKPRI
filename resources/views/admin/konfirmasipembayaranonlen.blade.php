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
    height: 150vh; /* 100% tinggi dari viewport */
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
    @include('admin.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pemesanan</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @if($status==0)
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Validasi Konfirmasi Online Pelanggan</h3><br>
                @if (session()->has('berhasilvalidasi'))
                <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                    {{ session('berhasilvalidasi') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                </div>
                <div class="card-body p-2">
                    @if ($terdapat>0)
                    <table class="table table-striped projects" id="dataTable">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    No
                                </th>
                                <th style="width: 10%">
                                    Jenis Kamar
                                </th>
                                <th style="width: 10%">
                                    Pelanggan id
                                </th>
                                <th style="width: 10%" class="text-center">
                                    Tanggal Pesan
                                </th>
                                <th style="width: 10%">
                                    Tanggal Bayar
                                </th>
                                <th style="width: 10%">
                                    Metode Pembayaran
                                </th>
                                <th style="width: 10%">
                                    Total Tagihan
                                </th>
                                <th style="width: 15%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($pemesananDanPembayaran as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $item->kamar->jenis_kamar }}
                            </td>
                            <td>
                                {{ $item->pelanggan_id }}
                            </td>
                            <td>
                                {{ $item->tgl_pesan }}
                            </td>
                            @foreach ( $item->pembayaran as $pembayaran )
                            <td>
                                <a>
                                    {{ $pembayaran->tgl_bayar}}
                                </a>
                            </td>
                            <td>
                                <a>
                                {{ $pembayaran->metode_pembayaran }}
                                </a>
                            </td>
                            @endforeach
                            <td>
                                <a>
                                Rp. {{ $item->total_harga }}
                                </a>
                            </td>
                            <td class="project-actions" >
                                    <a class="btn btn-info " href="/validasibayaradmin/{{ $item->id }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Konfirmasi Bayar
                                    </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @elseif($terdapat==0)
                        <div class="row p-3 text-center">
                            <h6>Maaf, Belum Ada Konfirmasi Pembayaran yang di lakukan oleh Pelanggan terkait Pemesanan yang dilakukannya untuk saat ini.</h6>
                        </div>
                    @endif

                </div>
            </div>
            @elseif($status==1)
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="width: 35rem;">
                        <div class="card-header bg-black">
                        Validasi Pembayaran Pelanggan
                        </div>
                        <div class="card-body">
                            <div class="detailpemesanan2 text-center">
                                <div><b><h6>Total Tagihan</h6></b></div>
                                <div><b><h3>{{ 'Rp.' . number_format($pemesananDanPembayaran->total_harga , 2, ',', '.') }}</h3></b></div>
                            </div>
                            <form>
                                @foreach ($pemesananDanPembayaran->pembayaran as $pembayaran)
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

                                @endforeach
                            </div>
                            <div class="card-footer text-right">
                                <a type="button" href="/fixkonfirmasiadmin/{{ $pemesananDanPembayaran->id }}" class="btn btn-success">Validasi Pembayaan</a>
                                <a type="button" href="/konfirmasibayaradmin" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 ps-4">
                    <div class="card">
                        <div class="card-header bg-black text-white">
                        Detail Pemesanan Pelanggan
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="card col-auto">
                                    <div class="zoom-effect">
                                        <img src="{{ asset('images/bahan1.jpeg')}}" class="card-img-top" alt="...">
                                    </div>
                                    <div class="card-body bg-tan text-center   ">
                                        <h3 class="card-title text-center" style="color:black;background:#ededed;width:100%;"><b>{{ $pemesananDanPembayaran->kamar['jenis_kamar'] }}</b></h3>
                                        <div class="card-text" style="color: black;">
                                        <div class="row maindetailpemesanan">
                                            <div class="col-md-6 detailpemesanan">
                                                <div><b><p>Tanggal Check-In</p></b></div>
                                                <div style="margin-top: -1rem;"><p>{{ $checkin }}</b></div>
                                            </div>
                                            <div class="col-md-6 detailpemesanan">
                                                <div><b><p>Tanggal Check-Out</p></b></div>
                                                <div style="margin-top: -1rem;"><p>{{ $checkout }}</p></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row maindetailpemesanan">
                                            <div class="col-md-6 detailpemesanan" style="margin-top: -1rem;">
                                                <div><b><p>Tanggal Pesan</p></b></div>
                                                <div style="margin-top: -1rem;"><p>{{ $tglpesan }}</p></div>
                                            </div>
                                            <div class="col-md-6 detailpemesanan" style="margin-top: -1rem;">
                                                <div><b><p>Lama Menginap</p></b></div>
                                                <div style="margin-top: -1rem;"><p>{{ $pemesananDanPembayaran->lama_inap }} Hari</p></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row maindetailpemesanan">
                                            <div class="col-md-6 detailpemesanan" style="margin-top: -1rem;">
                                                <div><b><p>Jumlah Kamar</p></b></div>
                                                <div style="margin-top: -1rem;"><p>{{ $pemesananDanPembayaran->jumlah_kamar }} Kamar</p></div>
                                            </div>
                                            <div class="col-md-6 detailpemesanan" style="margin-top: -1rem;">
                                                <div><b><p>Status Pemesanan</p></b></div>
                                                <div style="margin-top: -1rem;"><p>{{ $pemesananDanPembayaran->status_pesan }}</p></div>
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
                                    @foreach($dtKamar as $data)
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body" style="background-color:#ededed;color:#black;">
                                        <div class="macamfasilitas">
                                            <div class="fasilitas row">
                                                    <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Kapasitas </b></h6></div>
                                                    <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $data['kamar']->kapasitas }} Orang</b></h6></div>
                                            </div>
                                            <div class="fasilitas row">
                                                    <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Bed</b></h6></div>
                                                    <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $data['kamar']->bed }}</b></h6></div>
                                            </div>
                                            <div class="fasilitas row">
                                                    <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Pendingin</b> </h6></div>
                                                    <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $data['kamar']->pendingin_ruangan }}</b></h6></div>
                                            </div>
                                            <div class="fasilitas row">
                                                    <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Televisi</b> </h6></div>
                                                    <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $data['kamar']->tv }}</b></h6></div>
                                            </div>
                                            <div class="fasilitas row">
                                                    <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Kamar Mandi</b> </h6></div>
                                                    <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $data['kamar']->kamar_mandi }}</b></h6></div>
                                            </div>
                                            <div class="fasilitas row">
                                                    <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Peralatan Mandi </b></h6></div>
                                                    <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $data['kamar']->peralatan_mandi }}</b></h6></div>
                                            </div>
                                            <div class="fasilitas row">
                                                    <div class="col text-black" style="text-align: start;width:11.5rem;"><h6><b>Breakfast</b> </h6></div>
                                                    <div class="col-md-7 text-black" style="text-align: start;padding-left:0.5rem;width:18rem;"><h6><b>: {{ $data['kamar']->breakfast }}</b></h6></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if($rataRating==5)
                        <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr 1fr;width:30rem; align-items:center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                            </div>
                        </div>
                        @elseif($rataRating==4.5)
                        <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr 1fr;width:30rem;">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-half" viewBox="0 0 16 16">
                                    <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z"/>
                                </svg>
                            </div>
                        </div>
                        @elseif($rataRating==4)
                        <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr 1fr;width:30rem;">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                        </div>
                        @elseif($rataRating==3.5)
                        <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr 1fr;width:30rem;">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-half" viewBox="0 0 16 16">
                                    <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                        </div>
                        @elseif($rataRating==3)
                        <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr 1fr;width:30rem;">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                        </div>
                        @elseif($rataRating==2.5)
                        <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr 1fr;width:30rem;">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-half" viewBox="0 0 16 16">
                                    <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                        </div>
                        @elseif($rataRating==2.0)
                        <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr 1fr;width:30rem;">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-half" viewBox="0 0 16 16">
                                    <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                        </div>
                        @elseif($rataRating==1.5)
                        <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr 1fr;width:30rem;">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-half" viewBox="0 0 16 16">
                                    <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                        </div>
                        @elseif($rataRating==1.0)
                        <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr 1fr;width:30rem;">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                        </div>
                        @elseif($rataRating==0.5)
                        <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr 1fr;width:30rem;">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star-half" viewBox="0 0 16 16">
                                    <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                        </div>
                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        <!-- Default box -->
        <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('admin.layout.footer')

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
