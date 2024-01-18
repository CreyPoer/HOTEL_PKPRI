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
    @include('admin.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header    ) -->
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
                <div class="card-header row">
                    <div class="col-md-11">
                        <h3 class="card-title">Laporan Reservasi</h3>
                    </div>
                    <div class="col-md-1 text-end">
                        <a class="btn btn-danger btn-sm" style="margin-bottom: 20px;" href="{{ route('cetak_laporan') }}" target="_blank">
                            PDF
                        </a>
                    </div>
                </div>
                <div class="card-body p-2">
                    @if ($terdapat>0)
                    <table class="table table-striped projects text-center" id="dataTable">
                    <div>
                    </div>
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
                        @foreach ($PemesananAktif as $item)
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
                        <tfoot>
                            <tr>
                                <td colspan="7" style="text-align:right"><strong>Total Seluruh Pemasukan:</strong></td>
                                <td id="totalPemasukan" colspan="1"><strong>Rp. 0</strong></td>
                            </tr>
                        </tfoot>
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

        document.addEventListener('DOMContentLoaded', function () {
        // Ambil semua elemen dalam kolom "Total Pemasukan"
        var totalPemasukanCells = document.querySelectorAll('#dataTable tbody td:nth-child(8)');

        // Inisialisasi total
        var totalPemasukan = 0;

        // Hitung total
        totalPemasukanCells.forEach(function (cell) {
            totalPemasukan += parseInt(cell.textContent.replace('Rp.', '').replace('.', '').trim());
        });

        // Tampilkan total di footer
        document.getElementById('totalPemasukan').textContent = 'Rp.' + number_format(totalPemasukan, 0, ',', '.');
    });

    // Fungsi untuk memformat angka menjadi format mata uang
    function number_format(number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep,
            dec = (typeof decPoint === 'undefined') ? '.' : decPoint,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };

        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }

        return s.join(dec);
    }
</script>

</body>
