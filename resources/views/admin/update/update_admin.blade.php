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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Main Sidebar Container -->
    @include('admin.layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Katalog</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
        <div class="card">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Pengaturan Admin</p>
                </div>
                <div class="card-body">
                    <form action="update_akun" id="rooms-setting" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label class="form-label" for="nama"><strong>Nomor Kartu Tanda Penduduk</strong></label>
                                    <input class="form-control" type="text" id="no_ktp" value="{{$aktor->no_ktp}}" name="no_ktp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label class="form-label" for="nama"><strong>Nama</strong></label>
                                    <input class="form-control" type="text" id="nama" value="{{$aktor->nama}}" name="nama">
                                </div>
                            </div>
                        </div>
                        {{-- {{ $data->jenis_kelamin === 'Laki-laki' ? 'checked' : '' }} --}}
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <div class="row">
                                        <label class="form-label">Jenis kelamin</label>
                                    </div>
                                    <div class="col pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-laki" {{ $aktor->jenis_kelamin === 'Laki-laki' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan" {{ $aktor->jenis_kelamin === 'Perempuan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label class="form-label" for="alamat"><strong>Alamat</strong></label>
                                    <input class="form-control" type="text" id="alamat" value="{{$aktor->alamat}}" name="alamat">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label class="form-label" for="no_hp"><strong>No Telpon</strong></label>
                                    <input class="form-control" type="text" id="no_telp" value="{{$aktor->no_telp}}" name="no_telp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label class="form-label" for="email"><strong>Email</strong></label>
                                    <input class="form-control" type="email" id="email" value="{{$aktor->email}}" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label class="form-label" for="password"><strong>Password</strong></label>
                                    <input class="form-control" type="text" id="password" value="{{$aktor->password}}" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="modal-footer">
                                <button id="submitButton" name="kirim" class="btn btn-outline-dark w-175 shadow-none">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
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

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</body>
