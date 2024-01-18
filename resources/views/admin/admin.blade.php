<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Akun</title>

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
                <h1>Data Akun</h1>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
            <div class="card-header">
                @if (session()->has('tambah_akun'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('tambah_akun') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (session()->has('delete_akun'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('delete_akun') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('edit_akun'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('edit_akun') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h3 class="card-title">Daftar Profile Admin</h3>

                <div class="card-tools">
                <div class="col-12">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah_admin">
                        <i class="bi bi-plus-square"></i> + Tambah Admin
                    </button>
                </div>
                </div>
            </div>
            {{-- modal tambah --}}
            <div class="modal fade" id="tambah_admin" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form action="/tambah_akun" id="rooms-setting" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Admin</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Nomor Kartu Tanda Penduduk</label>
                                    <div class="col-sm-8">
                                        <input type="text" min="1" name="no_ktp" id="site_title_inp" class="form-control shadow-none" required>
                                    </div>
                                  </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" min="1" name="nama" id="site_title_inp" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" min="1" name="alamat" id="site_title_inp" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No Telpon</label>
                                    <input type="text" min="1" name="no_telp" id="site_title_inp" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" min="1" name="email" id="site_title_inp" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3 mt-1">
                                    <div class="row">
                                        <label class="form-label">Jenis kelamin</label>
                                    </div>
                                    <div class="col pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-laki" required>
                                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan" required>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                          </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    {{-- <input type="password" min="1" name="password" id="floatingInputPassword2" class="form-control shadow-none" required> --}}
                                    <input type="password" name="password" class="form-control" id="floatingInputPassword2" placeholder="Password" required>
                                    <span id="togglePassword2">
                                        <div id="terbuka2" class="text-end " style="display: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                            </svg>
                                        </div>
                                        <div id="tertutup2" class="text-end" style="display: block; padding-top:1px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486z"/>
                                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                                            <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708"/>
                                            </svg>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="role" id="role" value="admin" hidden>
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
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($admin as $item)
                    @if($item->role == 'Admin')
                    <tbody>
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
                            <td class="project-actions text-center">
                                <a class="btn btn-info btn-sm" href="/akun/{{ $item->id }}/edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="/akun/{{ $item->id }}/delete">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    @endif
                    @endforeach
                </table>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>

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
    const passwordField2 = document.getElementById('floatingInputPassword2');
    const togglePassword2 = document.getElementById('togglePassword2');
    const terbuka2 = document.getElementById('terbuka2');
    const tertutup2 = document.getElementById('tertutup2');

    togglePassword2.addEventListener('click', function () {
    if (terbuka2.style.display === 'none') {
        terbuka2.style.display = 'block';
        tertutup2.style.display = 'none';
        passwordField2.type = 'text';
    } else {
        terbuka2.style.display = 'none';
        tertutup2.style.display = 'block';
        passwordField2.type = 'password';
    }


    $(document).ready(function () {
        $('#dataTable').DataTable();
        });

        });

</script>

</body>
