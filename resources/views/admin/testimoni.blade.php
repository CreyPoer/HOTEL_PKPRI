<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Testimoni</title>

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
                <h1>Masukan</h1>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Masukan</h3>
                </div>
                <div class="card-body p-2">
                    @if ($terdapat>0)
                    <table class="table table-striped projects text-center" id="dataTable">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    No
                                </th>
                                <th style="width: 10%" class="text-center">
                                    ID Pelanggan
                                </th>
                                <th style="width: 10%">
                                    Jenis Kamar
                                </th>
                                <th style="width: 10%">
                                    Rating
                                </th>
                                <th style="width: 10%">
                                        Ulasan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($Testimoni as $item)
                        <tr>
                            <td>
                                <a>
                                {{ $loop->iteration}}
                                </a>
                            </td>
                            <td>
                                {{  $item->aktor->nama }}
                            </td>
                            <td>
                                {{ $item->kamar['jenis_kamar'] }}
                            </td>
                            <td>
                                <a>
                                    {{ $item->rating }}
                                </a>
                            </td>
                            <td>
                                <a>
                                {{ $item->ulasan }}
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
                <!-- /.card-body -->
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
