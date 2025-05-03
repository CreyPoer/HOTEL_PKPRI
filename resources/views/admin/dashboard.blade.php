<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin PKP-RI | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed" id="body">
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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 d-flex align-items-center justify-content-between">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <a class="info-box-icon bg-info elevation-1" href="/antrian"><i class="fas fa-hourglass-half"></i></a>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Reservasi Aktif</span>
                                <span class="info-box-number">
                                    {{ $digunakan }}
                                </span>
                            </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <a class="info-box-icon bg-success elevation-1" href="/laporanadmin"><i class="fas fa-shopping-cart"></i></a>

                            <div class="info-box-content">
                                <span class="info-box-text">Pemasukan</span>
                                <span class="info-box-number">{{ 'Rp ' . number_format($income, 0, ',', '.')}}</span>
                            </div>
                                <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <a class="info-box-icon bg-danger elevation-1" href=""><i class="fas fa-users"></i></a>
                            <div class="info-box-content">
                                <span class="info-box-text">Customer</span>
                                <span class="info-box-number">{{ $customer }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <a class="info-box-icon bg-warning elevation-1" href=""><i class="fas fa-users"></i></a>

                            <div class="info-box-content">
                                <span class="info-box-text">Admin</span>
                                <span class="info-box-number">{{ $admin }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Grafik -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Grafik Reservasi</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                            <canvas id="myChart" width="400" height="200"></canvas>
                                {{-- <div id="grafik" ></div> --}}
                            </div>
                        <!-- ./card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Main row -->
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Reservasi</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">ID</th>
                                            <th style="width: 10%;">Nama</th>
                                            <th style="width: 20%;">Waktu Reservasi</th>
                                            <th style="width: 20%;">Paket</th>
                                            <th style="width: 10%;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach($antrian as $item)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $item->aktor['nama'] }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->kamar['jenis_kamar'] }}</td>
                                        <td>
                                        @if ($item->status_checkin == 'Belum Check-In')
                                            <p class="mb-0 col-5"><span class="badge badge-danger">{{ $item->status_checkin }}</span></p>
                                        @endif
                                        @if ($item->status_checkin == 'Sedang Check-In')
                                            <p class="mb-0 col-5"><span class="badge badge-info">{{ $item->status_checkin }}</span></p>
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href="{{ route('lihatpemesananadmin') }}" class="btn btn-sm btn-secondary float-right">Cek Antrian</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box mb-3">
                                    <a class="info-box-icon bg-warning elevation-1" href=""><i class="fa fa-question-circle"></i></a>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Pelanggan Belum Check In</span>
                                        <span class="info-box-number">{{ $belum }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box mb-3">
                                    <a class="info-box-icon bg-success elevation-1" href=""><i class="fa fa-check-circle"></i></a>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Pelanggan Sedang Check In</span>
                                        <span class="info-box-number">{{ $sedang }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.left column -->

                    <!-- Right Column -->
                    <div class="col-md-4">
                        <!-- USERS LIST -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pelanggan</h3>

                                <div class="card-tools">
                                <span class="badge badge-success">{{ $customer }} Terdaftar</span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-2">
                                <ul class="users-list clearfix">
                                    @foreach ($users as $item)
                                <li>
                                    <img src="{{ asset('storage/image-pelanggan/'.$item->image) }}" alt="User Image" width="60px" height="60px">
                                    <!-- <i class="fas fa-user"></i> -->
                                    <a class="users-list-name" href="#">{{ $item->nama }}</a>
                                </li>
                                @endforeach
                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <a href="{{ route('akuncustomer') }}">Cek Pelanggan</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->

                        <!-- PRODUCT LIST -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Kamar</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                @foreach($kamar as $item)
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <li class="item">
                                        <div class="product-img">
                                        <img src="{{ asset('storage/image-kamar/'.$item->image)}}" alt="Gambar" class="img-size-50">
                                        </div>
                                        <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title"> {{ $item->jenis_kamar }}
                                            <span class="badge badge-warning float-right">Rp {{ $item->harga_permalam }}</span></a>
                                        <span class="product-description">

                                        </span>
                                        </div>
                                    </li>
                                <!-- /.item -->
                                </ul>
                                @endforeach
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <a href="/kamar/{{ 0 }}" class="uppercase">Cek Jenis Kamar</a>
                            </div>
                        <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.right column -->
                </div>
                <!-- /.row (main row) -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('admin.layout.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('lte/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('lte/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('lte/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('lte/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
{{-- <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script> --}}
{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('lte/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('lte/dist/js/pages/dashboard2.js') }}"></script>

<script>
    // Data yang diterima dari controller
    var totalHarga = <?php echo json_encode($total_harga)?>;

    // Label bulan (sesuaikan dengan data yang diharapkan)
    var bulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    // Inisialisasi chart pada elemen canvas dengan ID 'myChart'
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Jenis grafik, misalnya 'bar', 'line', dll.
        data: {
            labels: bulan, // Label bulan
            datasets: [{
                label: 'Nominal Pendapatan',
                data: totalHarga, // Data pendapatan
                backgroundColor: 'rgba(0, 255, 0, 0.2)', // Warna latar belakang
                borderColor: 'rgba(0, 255, 0, 1)', // Warna garis batas
                borderWidth: 1 // Lebar garis batas
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Mulai dari nilai 0 pada sumbu Y
                }
            }
        }
    });
</script>

<script>
    function toggleMode() {
  const body = document.getElementById('body');
  const modeSwitch = document.getElementById('modeSwitch');

  // Toggle the dark-mode class on the body based on the switch state
  body.classList.toggle('dark-mode', modeSwitch.checked);
  body.classList.toggle('light-mode', !modeSwitch.checked);
}
</script>
</body>
</html>
