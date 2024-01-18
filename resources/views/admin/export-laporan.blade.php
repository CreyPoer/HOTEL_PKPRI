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
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header    ) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pemasukan</h1>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Laporan Pemasukan</h3>
                </div>
                <div class="card-body p-2">
                    @if ($terdapat>0)
                    <table class="table table-striped projects text-center" >
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    No
                                </th>
                                <th style="width: 10%" class="text-center">
                                    Tanggal Pesan
                                </th>
                                <th style="width: 10%" class="text-center">
                                    Jenis Kamar
                                </th>
                                <th style="width: 10%">
                                    Tanggal Bayar
                                </th>
                                <th style="width: 10%">
                                    Metode Pembayaran
                                </th>
                                <th style="width: 10%">
                                    Pemasukan Pemesanan
                                </th>
                                <th style="width: 10%">
                                    Biaya Tambahan
                                </th>
                                <th style="width: 10%">
                                    Total Pemasukan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($riwayat as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $item->tgl_pesan }}
                            </td>
                            <td>
                                {{ $item->kamar->jenis_kamar }}
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
                                    {{ 'Rp.' . number_format($item->total_harga , 0, ',', '.') }}
                                </a>
                            </td>
                            <td>
                                <a>
                                    {{ 'Rp.' . number_format($item->biaya_tambahan , 0, ',', '.') }}
                                </a>
                            </td>
                            <td>
                                <a>
                                {{ 'Rp.' . number_format($item->total_harga+$item->biaya_tambahan , 0, ',', '.') }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @elseif($terdapat==0)
                        <div class="row p-3 text-center">
                            <h6><b>Maaf</b>, Belum Ada Masukan untuk pelayanan dan fasilitas hotel di website.</h6>
                        </div>
                    @endif

                </div>
            </div>

        <!-- Default box -->
        <!-- /.card -->

        </section>
        <!-- /.content -->
    <!-- /.content-wrapper -->
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

<script type="text/javascript">
    window.print();
</script>

</body>
