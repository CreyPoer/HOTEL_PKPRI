<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Kamar;
use App\Models\Rekening;
use Carbon\Carbon;
use App\Models\Testimoni;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pelanggan_id = $request->input('pelanggan_id');
        $kamar_id = $request->input('kamar_id');
        $tgl_pesan = $request->input('tgl_pesan');
        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');
        $lama_inap = $request->input('lama_inap');
        $jumlah_kamar = $request->input('jumlah_kamar');
        $total_harga = $request->input('total_harga');


        Pemesanan::create([
            'pelanggan_id' => $pelanggan_id,
            'kamar_id' => $kamar_id,
            'tgl_pesan' => $tgl_pesan,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'lama_inap' => $lama_inap,
            'jumlah_kamar' => $jumlah_kamar,
            'total_harga' => $total_harga,
            'status_pesan' => 'Belum Aktif',
            'status_checkin' => 'Belum Check-In',
            'status_ulasan' => 'Belum Diulas',
            'status_pembayaran' => 'Belum Bayar',
        ]);


         return redirect('/pesananpelanggan/'. $pelanggan_id)->with('succespesan', 'Pemesanan Kamar Anda Berhasil dilakukan, silahkan melakukan konfirmasi pembayaran');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan,$id)
    {
        $PesananAnda = Pemesanan::where('pelanggan_id',$id)->with('kamar')->orderBy('tgl_pesan', 'desc')->get();
        $tanggalHariIni = Carbon::now()->toDateString();
        $terdapat =count($PesananAnda);
        $semuaKamar = Kamar::all();
        $jumlahPemesananPelanggan=Pemesanan::where('pelanggan_id',$id)
        ->where('status_pembayaran','Belum Bayar')->get();

        $jumlah=count($jumlahPemesananPelanggan);
        $kategoriKamar = []; // Menyimpan kategori-kategori unik
        $jeniskamar=[];
        foreach ($semuaKamar as $kamar) {
            $kategori = $kamar->kategori_kamar;
            $jenis = $kamar->jenis_kamar;
            // Tambahkan kategori ke dalam array jika belum ada
            if (!in_array($kategori, $kategoriKamar)) {
                $kategoriKamar[] = $kategori;
            }
            if (!in_array($jenis, $jeniskamar)) {
                $jeniskamar[] = $jenis;
            }
        }
        $home=0;
        return view('pelanggan.pemesananpelanggan', compact('tanggalHariIni','terdapat','home','PesananAnda','jeniskamar','kategoriKamar','jumlah'));
    }

    public function lihatsemua(Request $request, $id){
        $Pemesanan = Pemesanan::where('id',$id)->first();
        $id_pemesanan = $Pemesanan->id;
        $status_pesan = $Pemesanan->status_pesan;
        $status_checkin = $Pemesanan->status_checkin;
        $status_pembayaran = $Pemesanan->status_pembayaran;
        $status_ulasan = $Pemesanan->status_ulasan;
        $Pembayaran = Pembayaran::where('pemesanan_id',$id)->first();
        $metode_pembayaran = $Pembayaran->metode_pembayaran;
        return view('admin.detailantrian', compact('Pemesanan','metode_pembayaran','status_pesan','status_checkin','status_pembayaran','status_ulasan'));
    }

    public function lihat(Pemesanan $pemesanan,$id)
    {
        $PesananAnda = Pemesanan::where('id',$id)->first();
        $PembayaranAnda = Pembayaran::where('pemesanan_id',$id)->first();
        $cariidkamar = $PesananAnda->kamar_id;
        $id_pemesanan = $PesananAnda->id;
        $check_in = $PesananAnda->check_in;
        $check_out = $PesananAnda->check_out;
        $tgl_pesan = $PesananAnda->tgl_pesan;
        $pelanggan_id = $PesananAnda->pelanggan_id;
        $status_pembayaran = $PesananAnda->status_pembayaran;
        $status_pesanan=$PesananAnda->status_pesan;
        $status_checkin=$PesananAnda->status_checkin;
        $status_ulasan=$PesananAnda->status_ulasan;
        $dataKamar = Kamar::where('id',$cariidkamar)->first();
        $namakamar = $dataKamar->jenis_kamar;
        $bedaya = Kamar::where('jenis_kamar',$namakamar)->get();
        $dtKamar = [];

        $tglpesan = Carbon::createFromFormat('Y-m-d', $tgl_pesan)->translatedFormat('d F Y');
        $checkin = Carbon::createFromFormat('Y-m-d', $check_in)->translatedFormat('d F Y');
        $checkout = Carbon::createFromFormat('Y-m-d', $check_out)->translatedFormat('d F Y');

        $rekening = Rekening::all();

        if ($status_pesanan == "Belum Aktif" && $status_pembayaran == "Belum Bayar") {
            $status = 0;
        } elseif ($status_pesanan == "Belum Aktif" && $status_pembayaran == "Menunggu Konfirmasi") {
            $status = 1;
        } elseif ($status_pesanan == "Aktif" && ($status_pembayaran == "Sudah Bayar" || $status_pembayaran == "Masih DP") && $status_checkin == "Belum Check-In") {
            $status = 2;
        } elseif ($status_pesanan == "Aktif" && $status_pembayaran == "Sudah Bayar" && $status_checkin == "Sedang Check-In") {
            $status = 3;
        } elseif ($status_pesanan == "Sudah Aktif" && $status_pembayaran == "Sudah Bayar" && $status_checkin == "Sudah Check-Out" && $status_ulasan == "Belum Diulas") {
            $status = 4;
        } elseif ($status_pesanan == "Sudah Aktif" && $status_pembayaran == "Sudah Bayar" && $status_checkin == "Sudah Check-Out" && $status_ulasan == "Sudah Diulas") {
            $status = 5;
        }

        $jumlahPemesananPelanggan=Pemesanan::where('pelanggan_id',$pelanggan_id)
        ->where('status_pembayaran','Belum Bayar')->get();

        $jumlah=count($jumlahPemesananPelanggan);
        $kategoriKamar = []; // Menyimpan kategori-kategori unik
        $jeniskamar=[];
        $semuaKamar = Kamar::all();
        foreach ($semuaKamar as $kamar) {
            $kategori = $kamar->kategori_kamar;
            $jenis = $kamar->jenis_kamar;

            // Tambahkan kategori ke dalam array jika belum ada
            if (!in_array($kategori, $kategoriKamar)) {
                $kategoriKamar[] = $kategori;
            }
        }

        foreach ($bedaya as $kamar) {
            $testimonis = Testimoni::where('kamar_id', $cariidkamar)->get();

            $jumlahTestimoni = $testimonis->count();
            $totalRating = $testimonis->sum('rating');
            $rataRating = $jumlahTestimoni > 0 ? $totalRating / $jumlahTestimoni : 0;

            $dtKamar[] = [
                'kamar' => $kamar,
                'rate' => $rataRating,
            ];

        }
        $tanggalHariIni = now()->toDateString();
        $home=0;

        return view('pelanggan.detailpemesananpelanggan', compact('home','tanggalHariIni','status','rekening','rataRating','PesananAnda','dtKamar','namakamar','cariidkamar','id_pemesanan','pelanggan_id','checkin','checkout','tglpesan','kategoriKamar','jumlah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan)
    {
        //
    }

    public function lihatpemesananadmin()
    {
        $Pemesanan = Pemesanan::all();
        $terdapat = count($Pemesanan);
        return view('admin.antrian', compact('terdapat','Pemesanan'));

    }
    public function lihatpemesananaktifadmin()
    {
        $PemesananAktif = Pemesanan::where('status_pesan', 'Aktif')
        ->where('status_checkin','Belum Check-In')
        ->where(function ($query) {
            $query->where('status_pembayaran', 'Sudah Bayar')
                ->orWhere('status_pembayaran', 'Masih DP');
        })
        ->get();
        $terdapat = count($PemesananAktif);
        return view('admin.pesananaktifpelanggan', compact('terdapat','PemesananAktif'));

    }
    public function validasicheckpelangganadmin(Request $request,$id){
        Pemesanan::where('id', $id)->update(['status_checkin'=>'Sedang Check-In']);
        $PemesananAktif = Pemesanan::where('status_pesan', 'Aktif')
        ->where('status_checkin','Belum Check-In')
        ->where(function ($query) {
            $query->where('status_pembayaran', 'Sudah Bayar')
                ->orWhere('status_pembayaran', 'Masih DP');
        })
        ->get();
        $terdapat = count($PemesananAktif);
        $terdapat = count($PemesananAktif);
        return view('admin.pesananaktifpelanggan', compact('terdapat','PemesananAktif'));
    }
    public function validasicheckoutpelangganadmin(Request $request){
        $id_pemesanan=$request->id;
        $biaya_tambahan=$request->biaya_tambahan;
        Pemesanan::where('id', $id_pemesanan)->update(['status_checkin'=>'Sudah Check-Out','status_pesan'=>'Sudah Aktif','biaya_tambahan'=> $biaya_tambahan]);
        return redirect('/pelanggancheckinadmin');
    }
    public function lihatpelanggansedangcheckinadmin()
    {
        $PemesananPelangganCheckIn = Pemesanan::where('status_pesan', 'Aktif')
        ->where('status_pembayaran', 'Sudah Bayar')->where('status_checkin','Sedang Check-In')
        ->get();
        $terdapat = count($PemesananPelangganCheckIn);
        return view('admin.pelanggancheckin', compact('terdapat','PemesananPelangganCheckIn'));

    }


    public function konfirmasibayar(){
        $pemesananDanPembayaran = Pemesanan::with('pembayaran')->whereHas('pembayaran', function($query) {
            $query->where('status_pembayaran', 'Menunggu Konfirmasi')->where('metode_pembayaran', 'ONLINE');
        })->get();
        $terdapat = count($pemesananDanPembayaran);
        $status=0;
        return view('admin.konfirmasipembayaranonlen', compact('status','terdapat','pemesananDanPembayaran'));
    }

    public function fixkonfirmasi(Request $request,$id){
        $Pembayaran=Pembayaran::where('pemesanan_id',$id)->first();
        $checkdp=$Pembayaran->jumlah_dp;

        if($checkdp==0){
            Pemesanan::where('id', $id)->update(['status_pesan'=>'Aktif','status_pembayaran' => 'Sudah Bayar']);
        }else{
            Pemesanan::where('id', $id)->update(['status_pesan'=>'Aktif','status_pembayaran' => 'Masih DP']);
        }
         // Mengasumsikan status_ulasan adalah boolean
        return redirect('/konfirmasibayaradmin')->with('berhasilvalidasi', 'Konfirmasi Pembayaran Pelanggan telah berhasil, Data akan secara otomatis akan masuk kedalam Laporan');

    }
    public function laporanadmin(){
        $PemesananAktif = Pemesanan::with('pembayaran')->whereHas('pembayaran', function($query) {
            $query->where('status_pembayaran','Sudah Bayar')->where('status_pesan','Sudah Aktif');
        })->get();
        $terdapat = count($PemesananAktif);
        return view('admin.laporan', compact('terdapat','PemesananAktif'));
    }
    public function cetak_laporan()
    {
        $riwayat = Pemesanan::with('pembayaran')->whereHas('pembayaran', function($query) {
            $query->where('status_pembayaran','Sudah Bayar')->where('status_pesan','Sudah Aktif');
        })->get();
        $terdapat = count($riwayat);
        return view('admin/export-laporan',compact('riwayat','terdapat'));
    }
    public function validasibayar(Request $request,$id){
        $pemesananDanPembayaran = Pemesanan::with('pembayaran')
        ->where('id', $id) // Menyesuaikan dengan ID yang diterima
        ->whereHas('pembayaran', function($query) {
            $query->where('status_pembayaran', 'Menunggu Konfirmasi');
        })
        ->first();

        $cariidkamar = $pemesananDanPembayaran->kamar_id;
        $check_in = $pemesananDanPembayaran->check_in;
        $check_out = $pemesananDanPembayaran->check_out;
        $tgl_pesan = $pemesananDanPembayaran->tgl_pesan;
        $dataKamar = Kamar::where('id',$cariidkamar)->first();
        $namakamar = $dataKamar->jenis_kamar;
        $bedaya = Kamar::where('jenis_kamar',$namakamar)->get();
        $dtKamar = [];

        $tglpesan = Carbon::createFromFormat('Y-m-d', $tgl_pesan)->translatedFormat('d F Y');
        $checkin = Carbon::createFromFormat('Y-m-d', $check_in)->translatedFormat('d F Y');
        $checkout = Carbon::createFromFormat('Y-m-d', $check_out)->translatedFormat('d F Y');

        foreach ($bedaya as $kamar) {
            $testimonis = Testimoni::where('kamar_id', $cariidkamar)->get();

            $jumlahTestimoni = $testimonis->count();
            $totalRating = $testimonis->sum('rating');
            $rataRating = $jumlahTestimoni > 0 ? $totalRating / $jumlahTestimoni : 0;

            $dtKamar[] = [
                'kamar' => $kamar,
                'rate' => $rataRating,
            ];

        }


    $terdapat =1;
    $status = 1;
    return view('admin.konfirmasipembayaranonlen', compact('dtKamar','status', 'terdapat', 'pemesananDanPembayaran','checkin','checkout','tglpesan','rataRating'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesanan $pemesanan,$id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->pembayaran()->delete();
        $id_pelanggan = $pemesanan->pelanggan_id;

        if ($pemesanan->delete()){
            return redirect('/pesananpelanggan/'.$id_pelanggan)->with('berhasilhapus', 'Pemesanan Kamar Anda Berhasil Dihapus');
            }
    }
}
