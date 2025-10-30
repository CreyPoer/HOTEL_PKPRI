<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Akun</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
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
                        <h1>Daftar Customer</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                @if (session()->has('delete_akun'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('delete_akun') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <h3 class="card-title">Daftar Profile Customer</h3>
            <div class="card-tools">
                <div class="col-12">
                </div>
            </div>
            </div>
            <div class="card-body p-3">
                <table class="table table-striped projects" id="dataTable">
                    <thead>
                        <tr class="text-center">
                            <th>
                                ID
                            </th>
                            <th>
                                Nama
                            </th>
                            <th>
                                Alamat
                            </th>
                            <th>
                                No Telpon
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Gambar
                            </th>
                            {{-- <th class="text-center">
                                Action
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $counter = 1;
                    @endphp
                        @foreach ($cust as $item)
                        @if($item->role == 'Pelanggan')
                        <tr class="text-center">
                            <td>
                                {{ $counter++ }}
                            </td>
                            <td>
                                {{ $item->nama }}
                            </td>
                            <td>
                                {{ $item->alamat }}
                            </td>
                            <td>
                                {{ $item->no_telp }}
                            </td>
                            <td>
                                {{ $item->email}}
                            </td>
                            <td>
                                <img src="{{ asset('gambar-user/'.$item->image)}}" style="width: 130px" >
                            </td>
                            {{-- <td class="project-actions text-center">
                                <a class="btn btn-danger btn-sm" href="/akun/{{ $item->id }}/delete">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td> --}}
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>
</body>
