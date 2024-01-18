<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PKP-RI Kab. Bangkalan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!-- Navbar  -->

    <!-- Content -->
    {{-- <section class="container-fluid"> --}}
        <div class="p-5 bg-white d-flex flex-column gap-2">
            <div class=" m-0 p-0 d-flex justify-content-evenly">
                <img src="{{ asset('assets/img/normal_koperasi.png') }}" class="" alt="..." width="110" height="110">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h4 class="fw-semibold">PUSAT KOPERASI PEGAWAI REPUBLIK INDONESIA</h4>
                    <h4 class="fw-semibold">KABUPATEN BANGKALAN</h4>
                    <h6 class="fw-semibold">Jln. Panglima Sudirman 112A Telp.(031)3098769</h6>
                    <h6 class="fw-semibold">Bangkalan-6911 Email: pkpri.bangkalan1@gmail.com</h6>
                </div>
            </div>
            <hr class="border border-black border-3 opacity-100">
            <div class=" m-0 p-0 d-flex justify-content-between align-items-start">
                <div class="d-flex flex-column p-0">
                    <p class="m-0 fw-semibold" style="font-size: 16px">Pemesan :</p>
                    <p class="m-0 " style="font-size: 16px">Nama: {{ auth()->user()->nama }}</p>
                    <p class="m-0 " style="font-size: 16px">No Hp: {{ auth()->user()->no_hp }}</p>
                    <p class="m-0 " style="font-size: 16px">Email: {{ auth()->user()->email }}</p>
                </div>
                <div class="d-flex flex-column p-0">
                    <p class="m-0 fw-semibold" style="font-size: 16px">Pesanan :</p>
                    <p class="m-0 " style="font-size: 16px">ID Pemesanan: {{ $invoice->id }}</p>
                    <p class="m-0 " style="font-size: 16px">Tanggal Pesan: {{ $invoice->created_at->format('Y-m-d') }}</p>
                    <p class="m-0 " style="font-size: 16px">Tanggal Sewa: {{ $invoice->tanggal_sewa}}</p>
                    <p class="m-0 " style="font-size: 16px">Jam Sewa: {{ $invoice->jam_sewa }}</p>
                </div>
                <div class="d-flex flex-column p-0">
                    <p class="m-0 " style="font-size: 16px">Acara: {{ $invoice->paket->nama_acara }}</p>
                    <p class="m-0 " style="font-size: 16px">Gedung Aula: {{ $invoice->paket->kategori }}</p>
                    <p class="m-0 " style="font-size: 16px">lama Sewa: {{ $invoice->lama_sewa}}</p>
                    <p class="m-0 " style="font-size: 16px">Kursi: {{ $invoice->tambah_kursi}}</p>
                    <p class="m-0 " style="font-size: 16px">Mic: {{ $invoice->tambah_mic }}</p>
                </div>
            </div>
            <div class="m-0 p-0">
                <table class="table table-bordered bg-dark">
                    <thead>
                        <tr>
                            <th>Tambahan</th>
                            <th>Paket/Barang/Jasa</th>
                            <th>Harga</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $invoice->paket->aula->nama_aula }}, {{ $invoice->paket->nama_acara }} </td>
                            <td>{{ 'Rp ' . number_format($invoice->paket->harga, 0, ',', '.') }}</td>
                            <td>{{ 'Rp ' . number_format($invoice->paket->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ $invoice->lama_sewa - $invoice->paket->lama_sewa }} jam</td>
                            <td>Lama Sewa</td>
                            <td>Rp 200.000</td>
                            <td>{{ 'Rp ' . number_format(($invoice->lama_sewa - $invoice->paket->lama_sewa) * 200000, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ $invoice->tambah_kursi - $invoice->paket->kursi }} unit</td>
                            <td>Kursi</td>
                            <td>Rp 3.000</td>
                            <td>{{ 'Rp ' . number_format(($invoice->tambah_kursi - $invoice->paket->kursi) * 3000, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ $invoice->tambah_mic - $invoice->paket->mic}} unit</td>
                            <td>Mic</td>
                            <td>Rp 50.000</td>
                            <td>{{ 'Rp ' . number_format(($invoice->tambah_mic - $invoice->paket->mic) * 50000, 0, ',', '.') }}</td>

                        </tr>
                        <tr>
                            <td>{{ $invoice->tambah_proyektor == 'iya' ? 'Pakai' : '-' }}</td>
                            <td>Proyektor</td>
                            <td>Rp 200.000</td>
                            <td>{{ 'Rp ' . number_format($invoice->tambah_proyektor == 'iya' ? 200000 : 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ $invoice->kebersihan == 'iya' ? 'Pakai' : '-' }}</td>
                            <td>Kebersihan</td>
                            <td>Rp 300.000</td>
                            <td>{{ 'Rp ' . number_format($invoice->kebersihan == 'iya' ? 300000 : 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ $invoice->ruang_transit == 'iya' ? 'Pakai' : '-' }}</td>
                            <td>Ruang Transit</td>
                            <td>Rp 250.000</td>
                            <td>{{ 'Rp ' . number_format($invoice->ruang_transit == 'iya' ? 250000 : 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ $invoice->kuade_luar == 'iya' ? 'Pakai' : '-' }}</td>
                            <td>Kuade Luar</td>
                            <td>Rp 300.000</td>
                            <td>{{ 'Rp ' . number_format($invoice->kuade_luar == 'iya' ? 300000 : 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ $invoice->gladi_bersih == 'iya' ? 'Pakai' : '-' }}</td>
                            <td>Gladi Bersih</td>
                            <td>Rp 300.000</td>
                            <td>{{ 'Rp ' . number_format($invoice->gladi_bersih == 'iya' ? 300000 : 0, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="m-0 p-0">
                <h5 class="fw-semibold pb-2">Metode Pembayaran Transfer</h5>
                <div class="m-0 p-0 d-flex justify-content-between align-items-start">
                    @if ($invoice->pembayaran->nama_metode !== 'Bayar Langsung')
                    <img src="{{ asset('assets/img/'.$invoice->pembayaran->gambar) }}" alt="..." width="150" height="130">
                    <div class="container m-0 ps-2">
                        <p class="m-0 " style="font-size: 16px">No Rek {{$invoice->pembayaran->no_rek}}</p>
                        <p class="m-0 " style="font-size: 16px">AN. {{$invoice->pembayaran->an}}</p>
                        <p class="m-0 " style="font-size: 16px">Pembayaran </p>
                    </div>
                    @else
                    <div class="container m-0 ps-2">
                        <p class="m-0 " style="font-size: 16px">{{$invoice->pembayaran->nama_metode}}</p>
                        <p class="m-0 " style="font-size: 16px">Silahkan Lakukan Pembayaran Ke tempat</p>
                    </div>
                    @endif
                    <div class="container m-0 row g-0">
                        <div class="col-md-12 p-0">
                            <div class="row g-0">
                                <p class="mb-0 col-6 fw-semibold" style="font-size: 16px;">Total Harga</p>
                                <p class="mb-0 col-1" style="font-size: 16px;">:</p>
                                <p class="mb-0 col-5" style="font-size: 16px;">
                                    {{ 'Rp ' . number_format($invoice->total_harga, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="row g-0">
                                <p class="mb-0 col-6 fw-semibold" style="font-size: 16px;">Status Pembayaran</p>
                                <p class="mb-0 col-1" style="font-size: 16px;">:</p>
                                @if ($invoice->status == 'Belum terverifikasi')
                                    <p class="mb-0 col-5"><span class="badge text-danger fs-6">{{ $invoice->status }}</span></p>
                                @endif
                                @if ($invoice->status == 'Lunas')
                                    <p class="mb-0 col-5"><span class="badge text-success fs-6">{{ $invoice->status }}</span></p>
                                @endif
                                @if ($invoice->status == 'Bayar DP')
                                    <p class="mb-0 col-5"><span class="badge text-info fs-6">{{ $invoice->status }}</span></p>
                                @endif
                                @if ($invoice->status == 'Menunggu Konfirmasi')
                                    <p class="mb-0 col-5"><span class="badge text-warning fs-6">{{ $invoice->status }}</span></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </section> --}}



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
