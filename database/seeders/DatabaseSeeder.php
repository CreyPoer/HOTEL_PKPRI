<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; // <-- TAMBAHKAN INI

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('aktors')->insert([
            [
            'no_ktp' => '3523012801030004',
            'nama' => 'Indra',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl.KH.Ach Marzuki',
            'no_telp' => '086741734136',
            'email' => 'indra@gmail.com',
            'password' => '123',
            'image' => '37478936481.jpg',
            'role' => 'Pelanggan',
            ],
            [
            'no_ktp' => '3523056801030089',
            'nama' => 'Andi',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl.KH.Ach Marzuki',
            'no_telp' => '086741734136',
            'email' => 'andi@gmail.com',
            'password' => '123456',
            'image' => '3523056801030089.jpeg',
            'role' => 'Pelanggan',
            ],
            [
            'no_ktp' => '35230128067530001',
            'nama' => 'Alif',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl.Nelongso',
            'no_telp' => '086741736386',
            'email' => 'alif@gmail.com',
            'password' => '123',
            'image' => '',
            'role' => 'Admin',
            ]
        ]);
        DB::table('users')->insert([
            [
            'name' => 'Indra',
            'email' => 'indra@gmail.com',
            'password' => Hash::make('123'),
            'image' => '37478936481.jpg',
            'role' => 'Pelanggan',
            ],
            [
            'name' => 'Andi',
            'email' => 'andi@gmail.com',
            'password' => Hash::make('123456'),
            'image' => '3523056801030089.jpeg',
            'role' => 'Pelanggan',
            ],
            [
            'name' => 'Alif',
            'email' => 'alif@gmail.com',
            'password' => Hash::make('123'),
            'image' => '',
            'role' => 'Admin',
            ]
        ]);
        DB::table('kamars')->insert([
            [
            'kategori_kamar' => 'EKONOMI',
            'jenis_kamar' => 'Ekonomi',
            'harga_permalam' => 125000,
            'kapasitas' => 2,
            'bed' => 'Double Bed',
            'pendingin_ruangan' => 'Kipas Angin',
            'TV' => 'Berwarna',
            'kamar_mandi' =>'Dalam',
            'peralatan_mandi' => 'Sabun Mandi dan Handuk',
            'breakfast' => 'Air Mineral dan Sarapan Pagi',
            'ketersediaan' => 1,
            'image' => 'Ekonomi.jpg',
            ],
            [
            'kategori_kamar' => 'EKONOMI',
            'jenis_kamar' => 'Ekonomi A',
            'harga_permalam' => 160000,
            'kapasitas' => 2,
            'bed' => 'Double Bed',
            'pendingin_ruangan' => 'Air Conditioner',
            'TV' => 'Berwarna',
            'kamar_mandi' =>'Dalam',
            'peralatan_mandi' => 'Sabun Mandi dan Handuk',
            'breakfast' => 'Air Mineral dan Sarapan Pagi',
            'ketersediaan' => 1,
            'image' => 'Ekonomi A.jpg',
            ],
            [
            'kategori_kamar' => 'EKONOMI',
            'jenis_kamar' => 'Ekonomi B',
            'harga_permalam' => 175000,
            'kapasitas' => 2,
            'bed' => 'Double Bed',
            'pendingin_ruangan' => 'Air Conditioner',
            'TV' => 'Berwarna',
            'kamar_mandi' =>'Dalam',
            'peralatan_mandi' => 'Sabun Mandi dan Handuk',
            'breakfast' => 'Air Mineral dan Sarapan Pagi',
            'ketersediaan' => 3,
            'image' => 'Ekonomi B.jpg',
            ],
            [
            'kategori_kamar' => 'STANDARD',
            'jenis_kamar' => 'Standard A',
            'harga_permalam' => 200000,
            'kapasitas' => 2,
            'bed' => '2 Single Bed',
            'pendingin_ruangan' => 'Air Conditioner',
            'TV' => 'Berwarna',
            'kamar_mandi' =>'Dalam',
            'peralatan_mandi' => 'Sabun Mandi dan Handuk',
            'breakfast' => 'Air Mineral dan Sarapan Pagi',
            'ketersediaan' => 5,
            'image' => 'Standard A.jpg',
            ],
            [
            'kategori_kamar' => 'STANDARD',
            'jenis_kamar' => 'Standard B',
            'harga_permalam' => 200000,
            'kapasitas' => 2,
            'bed' => 'Double Bed',
            'pendingin_ruangan' => 'Air Conditioner',
            'TV' => 'Berwarna',
            'kamar_mandi' =>'Dalam',
            'peralatan_mandi' => 'Sabun Mandi dan Handuk',
            'breakfast' => 'Air Mineral dan Sarapan Pagi',
            'ketersediaan' => 8,
            'image' => 'Standard B.jpg',
            ],
            [
            'kategori_kamar' => 'VIP',
            'jenis_kamar' => 'Vip',
            'harga_permalam' => 250000,
            'kapasitas' => 3,
            'bed' => 'Single Bed dan Double Bed',
            'pendingin_ruangan' => 'Air Conditioner',
            'TV' => 'Berwarna',
            'kamar_mandi' =>'Dalam',
            'peralatan_mandi' => 'Sabun Mandi dan Handuk',
            'breakfast' => 'Air Mineral dan Sarapan Pagi',
            'ketersediaan' => 3,
            'image' => 'Vip.jpg',
            ]
        ]);

        // =======================================================
        // PERUBAHAN DI BAGIAN PEMESANANS
        // =======================================================
        DB::table('pemesanans')->insert([
            [
            'pelanggan_id' => '1',
            'kamar_id' => '1',
            'tgl_pesan' => '2025-10-26', // <-- UBAH
            'tenggat_bayar' => '2025-10-27', // <-- UBAH
            'check_in' => '2024-01-16',
            'check_out' => '2024-01-17',
            'lama_inap' =>1,
            'jumlah_kamar' => 1,
            'total_harga' => 125000,
            'status_checkin' => 'Belum Check-In',
            'status_pesan' => 'Sudah Aktif',
            'status_ulasan' => 'Belum Diulas',
            'status_pembayaran' => 'Sudah Bayar',
            ],
            [
            'pelanggan_id' => '1',
            'kamar_id' => '5',
            'tgl_pesan' => '2025-10-26', // <-- UBAH
            'tenggat_bayar' => '2025-10-27', // <-- UBAH
            'check_in' => '2024-01-16',
            'check_out' => '2024-01-19',
            'lama_inap' => 1,
            'jumlah_kamar' => 3,
            'total_harga' => 600000,
            'status_checkin' => 'Belum Check-In',
            'status_pesan' => 'Sudah Aktif',
            'status_ulasan' => 'Belum Diulas',
            'status_pembayaran' => 'Sudah Bayar',
            ],
            [
            'pelanggan_id' => '2',
            'kamar_id' => '6',
            'tgl_pesan' => '2025-10-27', // <-- UBAH
            'tenggat_bayar' => '2025-10-28', // <-- UBAH
            'check_in' => '2024-01-23',
            'check_out' => '2024-01-24',
            'lama_inap' => 1,
            'jumlah_kamar' => 1,
            'total_harga' => 250000,
            'status_checkin' => 'Belum Check-In',
            'status_pesan' => 'Aktif',
            'status_ulasan' => 'Belum Diulas',
            'status_pembayaran' => 'Masih DP',
            ],
            [
            'pelanggan_id' => '2',
            'kamar_id' => '2',
            'tgl_pesan' => '2025-10-28', // <-- UBAH
            'tenggat_bayar' => '2025-10-29', // <-- UBAH
            'check_in' => '2024-01-15',
            'check_out' => '2024-01-16',
            'lama_inap' => 1,
            'jumlah_kamar' => 1,
            'total_harga' => 160000,
            'status_checkin' => 'Sedang Check-In',
            'status_pesan' => 'Aktif',
            'status_ulasan' => 'Belum Diulas',
            'status_pembayaran' => 'Sudah Bayar',
            ],
            [
            'pelanggan_id' => '2',
            'kamar_id' => '4',
            'tgl_pesan' => '2025-10-29', // <-- UBAH
            'tenggat_bayar' => '2025-10-30', // <-- UBAH
            'check_in' => '2024-01-17',
            'check_out' => '2024-01-18',
            'lama_inap' => 1,
            'jumlah_kamar' => 1,
            'total_harga' => 200000,
            'status_checkin' => 'Sudah Check-Out',
            'status_pesan' => 'Sudah Aktif',
            'status_ulasan' => 'Belum Diulas',
            'status_pembayaran' => 'Sudah Bayar',
            ],
            [
            'pelanggan_id' => '2',
            'kamar_id' => '4',
            'tgl_pesan' => '2025-10-30', // <-- UBAH
            'tenggat_bayar' => '2025-10-31', // <-- UBAH
            'check_in' => '2024-01-02',
            'check_out' => '2024-01-03',
            'lama_inap' => 1,
            'jumlah_kamar' => 2,
            'total_harga' => 400000,
            'status_checkin' => 'Belum Check-In',
            'status_pesan' => 'Belum Aktif',
            'status_ulasan' => 'Belum Diulas',
            'status_pembayaran' => 'Menunggu Konfirmasi',
            ]
        ]);

        // =======================================================
        // PERUBAHAN DI BAGIAN PEMBAYARANS
        // =======================================================
        DB::table('pembayarans')->insert([
            [
            'pelanggan_id' => '1',
            'pemesanan_id' => '1',
            'tgl_bayar' => '2025-10-26', // <-- UBAH
            'metode_pembayaran' => 'ONLINE',
            'jumlah_pembayaran' => 125000,
            'rek_tujuan' => 'MANDIRI',
            'no_rek_tujuan' => '2202 7389214',
            'rek_asal' => 'MANDIRI',
            'no_rek_asal' => '2202 7389537',
            'atas_nama' => 'INDRA',
            ],
            [
            'pelanggan_id' => '1',
            'pemesanan_id' => '2',
            'tgl_bayar' => '2025-10-26', // <-- UBAH
            'metode_pembayaran' => 'ONLINE',
            'jumlah_pembayaran' => 600000,
            'rek_tujuan' => 'MANDIRI',
            'no_rek_tujuan' => '2202 7389214',
            'rek_asal' => 'MANDIRI',
            'no_rek_asal' => '2202 7389537',
            'atas_nama' => 'INDRA',
            ],
            [
            'pelanggan_id' => '2',
            'pemesanan_id' => '3',
            'tgl_bayar' => '2025-10-27', // <-- UBAH
            'metode_pembayaran' => 'OFFLINE',
            'jumlah_pembayaran' => 250000,
            'rek_tujuan' => null,
            'no_rek_tujuan' => null,
            'rek_asal' => null,
            'no_rek_asal' => null,
            'atas_nama' => null,
            ],
            [
            'pelanggan_id' => '2',
            'pemesanan_id' => '4',
            'tgl_bayar' => '2025-10-28', // <-- UBAH
            'metode_pembayaran' => 'OFFLINE',
            'jumlah_pembayaran' => 160000,
            'rek_tujuan' => null,
            'no_rek_tujuan' => null,
            'rek_asal' => null,
            'no_rek_asal' => null,
            'atas_nama' => null,
            ],
            [
            'pelanggan_id' => '2',
            'pemesanan_id' => '5',
            'tgl_bayar' => '2025-10-29', // <-- UBAH
            'metode_pembayaran' => 'OFFLINE',
            'jumlah_pembayaran' => 200000,
            'rek_tujuan' => null,
            'no_rek_tujuan' => null,
            'rek_asal' => null,
            'no_rek_asal' => null,
            'atas_nama' => null,
            ],
            [
            'pelanggan_id' => '2',
            'pemesanan_id' => '6',
            'tgl_bayar' => '2025-10-30', // <-- UBAH
            'metode_pembayaran' => 'OFFLINE',
            'jumlah_pembayaran' => 400000,
            'rek_tujuan' => null,
            'no_rek_tujuan' => null,
            'rek_asal' => null,
            'no_rek_asal' => null,
            'atas_nama' => null,
            ]
        ]);

        DB::table('rekenings')->insert([
            [
            'rek_tujuan' => 'Bank Jatim',
            'no_rek_tujuan' => '0253709618',
            'atas_nama' => ' HOTEL PKPRI',
            ],
            [
            'rek_tujuan' => 'Bank BRI',
            'no_rek_tujuan' => '0006-01-000884-56-9',
            'atas_nama' => 'HOTEL PKPRI',
            ],
        ]);
        DB::table('testimonis')->insert([
            [
            'pelanggan_id' => '1',
            'kamar_id' => '1',
            'rating' => '5',
            'ulasan' => 'Saya senang',
            ],
            [
            'pelanggan_id' => '1',
            'kamar_id' => '1',
            'rating' => '3',
            'ulasan' => 'Saya senang sekali',
            ],
            [
            'pelanggan_id' => '1',
            'kamar_id' => '1',
            'rating' => '4',
            'ulasan' => 'Senang banget weh',
            ],
            [
            'pelanggan_id' => '1',
            'kamar_id' => '2',
            'rating' => '4',
            'ulasan' => 'Senang banget weh',
            ],
            [
            'pelanggan_id' => '1',
            'kamar_id' => '3',
            'rating' => '3',
            'ulasan' => 'Senang banget weh',
            ],
            [
            'pelanggan_id' => '1',
            'kamar_id' => '4',
            'rating' => '3',
            'ulasan' => 'Senang banget weh',
            ],
            [
            'pelanggan_id' => '1',
            'kamar_id' => '5',
            'rating' => '5',
            'ulasan' => 'Senang banget weh',
            ],
            [
            'pelanggan_id' => '1',
            'kamar_id' => '6',
            'rating' => '5',
            'ulasan' => 'Senang banget weh',
            ]
        ]);
        DB::table('penguruses')->insert([[
            'nama_pengurus' => 'Drs. H Edy Haryadi, M.Pd',
            'jabatan' => 'Ketua 1',
        ],[
            'nama_pengurus' => 'Aziz Syafiuddin, BSc, S.Sos',
            'jabatan' => 'Ketua 2',
        ],[
            'nama_pengurus' => 'Ciptaning Tekat, SKM, MM',
            'jabatan' => 'Sekretaris',
        ],[
            'nama_pengurus' => 'Mustakim, S.Pd',
            'jabatan' => 'Bendahara 1',
        ],[
            'nama_pengurus' => 'Nuzullah Qurfianto, SE',
            'jabatan' => 'Bendahara 2',
        ],[
            'nama_pengurus' => 'Drs. Ec.H Moh. Noer, MSA',
            'jabatan' => 'Koordinator',
        ],[
            'nama_pengurus' => 'Drs.Eddy Supyantoro',
            'jabatan' => 'Anggota',
        ],[
            'nama_pengurus' => 'Achmad Riady, SH, MH',
            'jabatan' => 'Anggota',
        ]]);

        // =======================================================
        // PERUBAHAN DI BAGIAN ANGGOTAS (SEMUA TANGGAL)
        // =======================================================
        DB::table('anggotas')->insert([[
            'nama_anggota' => 'Tunas Harapan',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Pengayoman',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Pemda',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Teratai',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Sumber Bahagia',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Adil Makmur',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Sentosa',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Sejahtera',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Bangkit',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Kopergu',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Anantakupa',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Anugerah',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Tunggal',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Api Alam',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Bhakti Husada',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Dewi Sri',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Karya Bakti',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Bima',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Sumber Rejeki',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Bakti Mulia',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Makmur',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Pawiyatan',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Karya Dharma',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Karya Makmur',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Bakti',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'KPPDK',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Melati',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Al-hidayah',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Barokah',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Mutiara',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Harapan',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Kokarperi',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Airdas',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Andini Jaya',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Bahtera Kencana',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Tiara',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Smada',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Trunojoyo',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Eka Prasetya',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Swasembada',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Tutwurihandayani',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Disbunda',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Eka Karsa',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Bhina Indag',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Citra',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Kopstik',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Ikhlas Beramal',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Beringin',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Harapan Kita',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Delima',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Rahmat',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Adiguna Sejahtera',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Wahana SMK Baru',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Bumi Permata Hati',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'BAPDA',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ],[
            'nama_anggota' => 'Tunas Mekar',
            'no' => ' ',
            'tanggal' => Carbon::now()->toDateString(), // <-- UBAH
            'pukul' => '09:00',
            'keterangan' => ' ',
        ]]);
    }
}