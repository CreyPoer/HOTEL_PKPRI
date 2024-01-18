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
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Pemesanan Aktif Pelanggan yang Belum Check In</h3><br>
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
                                    Pelanggan
                                </th>
                                <th style="width: 10%" class="text-center">
                                    Tanggal Pesan
                                </th>
                                <th style="width: 10%">
                                    Tanggal Check In
                                </th>
                                <th style="width: 10%">
                                    Tanggal Check In
                                </th>
                                <th style="width: 10%">
                                    Status Check In
                                </th>
                                <th style="width: 15%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($PemesananAktif as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $item->kamar->jenis_kamar }}
                            </td>
                            <td>
                                {{ $item->aktor->nama }}
                            </td>
                            <td>
                                {{ $item->tgl_pesan }}
                            </td>
                            <td>
                                <a>
                                    {{ $item->check_in}}
                                </a>
                            </td>
                            <td>
                                <a>
                                {{ $item->check_in }}
                                </a>
                            </td>
                            <td>
                                <a>
                                {{ $item->status_checkin }}
                                </a>
                            </td>
                            <td class="project-actions" >
                                @if($item->status_pembayaran=="Sudah Bayar")
                                <a class="btn btn-danger" href="/validasicheckpelangganadmin/{{ $item->id }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Pelanggan Check In
                                </a>
                            @elseif($item->status_pembayaran=="Masih DP")
                            <a class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#AdminKonfirmasiCheckinDP-{{ $item->id }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Pelanggan Check In
                            </a>
                            <div class="modal fade" id="AdminKonfirmasiCheckinDP-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Check In Pelanggan</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/validasipembayaranfulldpofflinecheckin" method="POST">
                                        @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="id_pemesanan" value="{{ $item->id }}">
                                        <input type="hidden" name="jumlah_pembayaran" value="{{  ($item->total_harga*50)/100 }}">
                                        <div class="row"><h6>Total Tagihan : <b>{{ $item->total_harga }}</b></h6></div>
                                        <div class="row"><h6>Sebelumnya anda telah menerima DP sebesar : <b>{{ ($item->total_harga*50)/100 }}</b></h6></div>
                                        <div class="row"><h6>Dengan menekan tombol dibawah, maka anda dengan sadar telah menerima pembayaran <b>full</b> secara <b>offline</b> terkait pesanan dari pelanggan saat pelanggan check-in</h6></div>
                                        <div class="row"><h6>Yaitu sebesar : <b>{{ ($item->total_harga*50)/100 }}</b></h6></div>
                                        <div class="row"><h6>Apakah Anda Yakin telah menerima pembayaran full secara offline dari pelanggan terkait pemesanan ini saat check in? </h6></div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-danger">Yakin</button>
                                    </div>
                                     </form>
                                  </div>
                                </div>
                              </div>
                            @endif
                          </td>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @elseif($terdapat==0)
                        <div class="row p-3 text-center">
                            <h6>Maaf, Belum Ada Pemesanan dari Pelanggan yang berstatus Aktif terkait Pemesanan yang dilakukannya untuk saat ini.</h6>
                        </div>
                    @endif

                </div>
            </div>


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
