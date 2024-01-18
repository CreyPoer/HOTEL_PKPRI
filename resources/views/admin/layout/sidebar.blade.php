<aside class="main-sidebar sidebar-dark-primary elevation-4 bg-black">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-center">
      <span class="brand-text font-weight-light">Admin Wisma Koperasi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex bg-white row" style="padding-left: 1.5rem;">
        <div class="col-md-2"><img src="{{ asset('video/hi.gif') }}" alt="GIF Image" width="20" height="20" ></div>
        <div class="col-md-5 text-dark pt-2 text-end " id="waktu"> </div>
        <div class="info col-md-5 pt-2" style="padding-left: 2rem;">
            <a href="#" class="d-block text-dark"><b>{{ auth()->user()->name }}</b></a>
        </div>
            {{-- <div class="image">
                <img src="{{ asset('storage/gambar-admin/'.auth()->user()->image)}}" class="img-circle elevation-2" alt="User Image" style="width: 4rem;height:4rem;">
            </div> --}}
        </div>

      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Calendar
                    </p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="/kamar/{{ 0 }}" class="nav-link">
                    <i class="nav-icon far fa-building"></i>
                    <p>
                        Kamar
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Pemesanan
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('lihatpemesananadmin') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pemesanan Pelanggan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('konfirmasibayar') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Konfirmasi Bayar Online</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/konfirmasibayarofflineadmin" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Konfirmasi Bayar Offline</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/lihatpemesananaktifadmin" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pesanan Aktif</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('lihatpelanggancheckinadmin') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pelanggan Check In</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('laporanadmin') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Laporan</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Daftar Akun
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('akunadmin') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('akuncustomer') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pelanggan</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('masukan') }}" class="nav-link">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>
                        Masukan
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('testimoni') }}" class="nav-link">
                        <i class="nav-icon fas fa-comment" aria-hidden="true"></i>
                    <p>
                        Testimoni
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-address-card"></i>
                    <p>
                        Pengurus
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="{{ route('daftar_anggota') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Anggota</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('daftar_pengurus') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengurus</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('daftar_pembayaran') }}" class="nav-link">
                    <i class="nav-icon far fa-regular fa-credit-card"></i>
                    <p>
                        Rekening
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                    <i class="nav-icon fas fa-arrow-circle-left"></i>
                    <p>
                        Log Out
                    </p>
                    </a>
                </li>
            </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <script>
        function updateWaktu() {
          var now = new Date();
          var jam = now.getHours();
          var pesan;

          if (jam >= 4 && jam < 12) {
            pesan = "Selamat Pagi";
          } else if (jam >= 12 && jam < 15) {
            pesan = "Selamat Siang";
          } else if (jam >= 15 && jam < 18) {
            pesan = "Selamat Sore";
          } else {
            pesan = "Selamat Malam";
          }

          var waktuElement = document.getElementById("waktu");
          waktuElement.textContent = pesan;
        }

        // Panggil fungsi updateWaktu setiap detik
        setInterval(updateWaktu, 1000);

        // Panggil fungsi untuk pertama kali
        updateWaktu();
      </script>
</aside>
