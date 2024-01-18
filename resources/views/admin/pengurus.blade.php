<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Pengurus</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                <h1>Daftar Pengurus</h1>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                @if (session()->has('tambah_pengurus'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('tambah_pengurus') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('delete_pengurus'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('delete_pengurus') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('edit_pengurus'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('edit_pengurus') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <h3 class="card-title">Pengurus PKP-RI</h3>

            <div class="card-tools">
                <div class="col-12">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah_pengurus">
                        <i class="bi bi-plus-square"></i> + Tambah Pengurus
                    </button>
                </div>
            </div>
            </div>
            {{-- modal tambah --}}
            <div class="modal fade" id="tambah_pengurus" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="/tambah_pengurus" id="rooms-setting" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Pengurus</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Pengurus</label>
                                    <input type="text" min="1" name="nama_pengurus" id="site_title_inp" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" min="1" name="jabatan" id="site_title_inp" class="form-control shadow-none" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-success text-white shadow-none">Kirim</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body p-3">
                <table class="table table-striped projects" id="dataTable">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Nama Pengurus
                            </th>
                            <th>
                                Jabatan
                            </th>
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengurus as $item)
                        <tr>
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                {{ $item->nama_pengurus }}
                            </td>
                            <td>
                                {{ $item->jabatan }}
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="/pengurus/{{ $item->id }}/edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="/pengurus/{{ $item->id }}/delete">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
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


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>
</body>
