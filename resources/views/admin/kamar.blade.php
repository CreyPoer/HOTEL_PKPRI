<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Kamar</title>

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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Daftar Kamar</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            @if($status==0)
            <div class="card">
                <div class="card-header">
                    @if (session()->has('succes'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('succes') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif (session()->has('succesUpdate'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('succesUpdate') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif (session()->has('errortidakdapathapus'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('errortidakdapathapus') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <h3 class="card-title">Data Daftar Kamar</h3>
                    <div class="card-tools">
                        <div class="col-12">
                            <a type="button" href="/kamar/{{ 1 }}"  class="btn btn-success float-right">+ Tambah Kamar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-2">
                    @if ($terdapat>0)
                    <table class="table table-striped projects" id="dataTable">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    ID
                                </th>
                                <th style="width: 5%" class="text-center">
                                    Gambar
                                </th>
                                <th style="width: 5%">
                                    Jenis Kamar
                                </th>
                                <th style="width: 5%">
                                    Harga Permalam
                                </th>
                                <th style="width: 5%">
                                    Kapasitas
                                </th>
                                <th style="width: 5%">
                                    Ketersediaan
                                </th>
                                <th style="width: 5%">
                                    Rating
                                </th>
                                <th style="width: 15%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($dataKamar as $item)
                        <tr class="text-center">
                            <td>
                                {{ $item['kamar']->id }}
                            </td>
                            <td>
                                <img src="{{ asset('gambar-kamar/'.$item['kamar']->image)}}" alt="" style="width: 8rem;height:5rem;">
                            </td>
                            <td>
                                <a>
                                    {{ $item['kamar']->jenis_kamar }}
                                </a>
                            </td>
                            <td>
                                <a>
                                Rp. {{ $item['kamar']->harga_permalam }}
                                </a>
                            </td>
                            <td>
                                <a>
                                {{ $item['kamar']->kapasitas }}
                                </a>
                            </td>
                            <td>
                                <a>
                                {{ $item['kamar']->ketersediaan }}
                                </a>
                            </td>
                            <td>
                                <a>
                                {{ $item['rata_rating'] }}
                                </a>
                            </td>
                            <td class="project-actions" >
                                <a class="btn btn-info " href="/admineditkamar/{{ 2 }}/{{ $item['kamar']->id }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#AdminHapusKamar_{{ $item['kamar']->id }}" >
                                    <i class="fas fa-trash">
                                    </i>
                                    Hapus
                                </a>
                                <div class="modal fade" id="AdminHapusKamar_{{ $item['kamar']->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Jenis Kamar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if($item['jumlahpesanan']>0||$item['jumlahtestimoni']>0)
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <div class="row">
                                                        <h6><b>Informasi</b> Data jenis kamar yang akan anda hapus ini, juga berada di beberapa tabel diantaranya:</h6>
                                                    </div>
                                                    <div class="row">
                                                        <h6><b>Tabel Pemesanan: terdapat sebanyak {{ $item['jumlahpesanan'] }} data </b></h6>
                                                    </div>
                                                    <div class="row">
                                                        <h6><b>Tabel Testimoni: terdapat sebanyak {{ $item['jumlahtestimoni'] }} data </b></h6>
                                                    </div>
                                                </div>
                                                <div class="row"><h6>Dari penjabaran diatas, anda akan berkemungkinan <b>tidak dapat menghapus</b> data jenis kamar ini</h6></div>
                                                <div class="row"><h6>Sekali lagi, Apakah Anda Yakin untuk menghapus data jenis kamar {{ $item['kamar']->jenis_kamar }} ini ? </h6></div>
                                                @else
                                                <div class="row"><h6>Apakah anda yakin untuk menghapus data jenis kamar {{ $item['kamar']->jenis_kamar }} ini ? </h6></div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <a type="button" href="/adminhapuskamar/{{ $item['kamar']->id }}" class="btn btn-danger">Yakin</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @elseif($terdapat==0)
                        <div class="row p-3 text-center">
                            <h6>Maaf, Belum Ada Jenis Kamar yang di masukkan ke database. Silahkan bisa menekan tombol <b>+Tambah Kamar</b> diatas</h6>
                        </div>
                    @endif

                </div>
                <!-- /.card-body -->
            </div>
            @elseif($status==1)
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 35rem;">
                        <div class="card-header bg-black">
                            Tambah Daftar Kamar
                        </div>
                        <div class="card-body">
                            <form method="post" action="/tambahjeniskamar" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col">
                                        <label for="exampleJenisKamar" class="form-label">Jenis Kamar</label>
                                    <input type="text" class="form-control" placeholder="Jenis Kamar" aria-label="Jenis Kamar" name="jenis_kamar">
                                    @error('jenis_kamar')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="col">
                                        <label for="exampleHargaPermalam" class="form-label">Harga Permalam</label>
                                    <input type="number" class="form-control" aria-label="Last name" name="harga_permalam">
                                    @error('harga_permalam')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col">
                                        <label for="kapasitas" class="form-label">Kapasitas</label>
                                    <input type="number" class="form-control"  aria-label="Kapasitas" name="kapasitas" min=1  >
                                    @error('kapasitas')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="col">
                                        <label for="ketersediaan" class="form-label">Ketersediaan</label>
                                    <input type="number" class="form-control" aria-label="Last name" name="ketersediaan" min=1 >
                                    @error('ketersediaan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col">
                                        <label for="bed" class="form-label">Bed</label>
                                    <input type="text" class="form-control"  aria-label="bed" name="bed" placeholder="Double bed dan Single Bed">
                                    @error('bed')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                    <div class="col">
                                        <label for="pendingin_ruagan" class="form-label">Pendingin Ruangan</label>
                                    <input type="text" class="form-control" aria-label="Last name" name="pendingin_ruangan" placeholder="Kipas dan Air Conditioner">
                                    @error('pendingin_ruangan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col">
                                        <label for="tv" class="form-label">TV</label>
                                    <input type="text" class="form-control"  aria-label="tv" name="tv" placeholder="Berwarna">
                                    @error('tv')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                    <div class="col">
                                        <label for="kamar_mandi" class="form-label">Kamar Mandi</label>
                                    <input type="text" class="form-control" aria-label="Last name" name="kamar_mandi" placeholder="Dalam">
                                    @error('kamar_mandi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                </div>
                                <div class="row g-3">
                                <div class="col">
                                    <label for="peralatan_mandi" class="form-label">Peralatan Mandi</label>
                                    <input type="text" class="form-control" aria-label="Last name" name="peralatan_mandi" placeholder="Sabun Mandi dan handuk">
                                    @error('peralatan_mandi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="col">
                                        <label for="break_fast" class="form-label">Break Fast</label>
                                    <input type="text" class="form-control"  aria-label="break_fast" name="breakfast" placeholder="Air Mineral dan Sarapan Pagi">
                                    @error('breakfast')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="kategori_kamar" class="form-label">Kategori Kamar</label>
                                        <input type="text" class="form-control"  aria-label="kategori_kamar" name="kategori_kamar" placeholder="EKONOMI">
                                        @error('kategori_kamar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleGambarKamar" class="form-label">Gambar Kamar</label>
                                    <div class="input-group mb-3">
                                        <input type="file" name="image" class="form-control" id="inputGroupFile02">
                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                    </div>
                                    @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                    </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">Tambah</button>
                            <a type="button" href="/kamar/{{ 0 }}" class="btn btn-danger">Kembali</a>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-black text-white">
                        Data Daftar Kamar
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Jenis Kamar</th>
                                    <th scope="col">Ketersediaan</th>
                                    <th scope="col">Rating</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($dataKamar as $item)
                                <tr class="text-center">
                                    <th scope="row"> {{ $item['kamar']->id }}</th>
                                    <td> {{ $item['kamar']->jenis_kamar }}</td>
                                    <td> {{ $item['kamar']->ketersediaan }}</td>
                                    <td> {{ $item['rata_rating']}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($status==2)
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 35rem;">
                        <div class="card-header bg-black">
                        Update Daftar Kamar
                        </div>
                        <div class="card-body">
                            <form method="post" action="/updatejeniskamar/{{ $Kamartertentu->id }}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="row g-3">
                                    <div class="col">
                                        <label for="exampleJenisKamar" class="form-label">Jenis Kamar</label>
                                    <input type="text" class="form-control" value="{{ $Kamartertentu->jenis_kamar }}" aria-label="Jenis Kamar" name="jenis_kamar">
                                    @error('jenis_kamar')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="col">
                                        <label for="exampleHargaPermalam" class="form-label">Harga Permalam</label>
                                    <input type="number" value="{{ $Kamartertentu->harga_permalam }}" class="form-control" aria-label="Last name" name="harga_permalam">
                                    @error('harga_permalam')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col">
                                        <label for="kapasitas" class="form-label">Kapasitas</label>
                                    <input type="number" class="form-control" value="{{ $Kamartertentu->kapasitas }}" aria-label="Kapasitas" name="kapasitas" min=1  >
                                    @error('kapasitas')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="col">
                                        <label for="ketersediaan" class="form-label">Ketersediaan</label>
                                    <input type="number" class="form-control" aria-label="Last name" name="ketersediaan" min=1 value="{{ $Kamartertentu->ketersediaan }}" >
                                    @error('ketersediaan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col">
                                        <label for="bed" class="form-label">Bed</label>
                                    <input type="text" class="form-control"  aria-label="bed" name="bed" value="{{ $Kamartertentu->bed }}">
                                    @error('bed')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                    <div class="col">
                                        <label for="pendingin_ruagan" class="form-label">Pendingin Ruangan</label>
                                    <input type="text" class="form-control" aria-label="Last name" name="pendingin_ruangan" value="{{ $Kamartertentu->pendingin_ruangan }}">
                                    @error('pendingin_ruangan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col">
                                        <label for="tv" class="form-label">TV</label>
                                    <input type="text" class="form-control"  aria-label="tv" name="tv" value="{{ $Kamartertentu->tv }}">
                                    @error('tv')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                    <div class="col">
                                        <label for="kamar_mandi" class="form-label">Kamar Mandi</label>
                                    <input type="text" class="form-control" aria-label="Last name" name="kamar_mandi" value="{{ $Kamartertentu->kamar_mandi }}">
                                    @error('kamar_mandi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                </div>
                                <div class="row g-3">
                                <div class="col">
                                    <label for="peralatan_mandi" class="form-label">Peralatan Mandi</label>
                                    <input type="text" class="form-control" aria-label="Last name" name="peralatan_mandi" value="{{ $Kamartertentu->peralatan_mandi }}">
                                    @error('peralatan_mandi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="col">
                                        <label for="break_fast" class="form-label">Break Fast</label>
                                    <input type="text" class="form-control"  aria-label="break_fast" name="breakfast" value="{{ $Kamartertentu->breakfast }}">
                                    @error('breakfast')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                                </div>
                                <div class="mb-3 pt-2">
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <img src="{{ asset('gambar-kamar/'.$Kamartertentu->image)}}" alt="" >
                                        </div>
                                    </div>
                                    <p>
                                        <a class="btn btn-outline-secondary" style="width:100%;" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Lihat Gambar Kamar Sebelumnya
                                        </a>
                                    </p>
                                    <small class="text-danger">Pilih file gambar dibawah ini untuk di upload, jika anda ingin <b>mengubah gambar</b> di database</small>
                                        <div class="input-group mb-3">
                                            <input type="file" name="image" class="form-control" id="inputGroupFile02">
                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                        </div>
                                    @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                    </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a type="button" href="/kamar/{{ 0 }}" class="btn btn-danger">Kembali</a>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-black text-white">
                        Data Daftar Kamar
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Jenis Kamar</th>
                                    <th scope="col">Ketersediaan</th>
                                    <th scope="col">Rating</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($dataKamar as $item)
                                <tr class="text-center">
                                    <th scope="row"> {{ $item['kamar']->id }}</th>
                                    <td> {{ $item['kamar']->jenis_kamar }}</td>
                                    <td> {{ $item['kamar']->ketersediaan }}</td>
                                    <td> {{ $item['rata_rating']}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
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
