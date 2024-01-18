<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Aktor;
use App\Models\Kamar;

class AdminController extends Controller
{
    public function dashboard()
    {
        $income = DB::table('pemesanans')->where('status_pembayaran', 'Sudah Bayar')->where('status_pesan', 'Sudah Aktif')->sum(DB::raw('total_harga','biaya_tambahan'));
        $digunakan = DB::table('pemesanans')->whereIn('status_pesan', ['Sudah Aktif'])->count();
        $customer = DB::table('aktors')->where('role', 'Pelanggan')->count();
        $admin = DB::table('aktors')->where('role', 'Admin')->count();
        $antrian = Pemesanan::limit(10)->whereIn('status_checkin', ['Belum Check-In', 'Sedang Check-In'])->get();
        $belum = Pemesanan::where('status_checkin','Belum Check-In')->whereIn('status_pesan', ['Aktif'])->count();
        $sedang = Pemesanan::where('status_checkin','Sedang Check-In')->whereIn('status_pesan', ['Aktif'])->count();
        $kamar = Kamar::all();
        $users = Aktor::limit(5)->orderBy('created_at', 'desc')->where('role', 'Pelanggan')->get();

        $total_harga = Pemesanan::select(DB::raw("CAST(SUM(total_harga) as int) as total_harga"))
        ->where('status_pembayaran', 'Sudah Bayar')
        ->where('status_pesan', 'Sudah Aktif')
        ->groupBy(DB::raw("Month(tgl_pesan)"))
        ->orderByRaw("Month(tgl_pesan)")
        ->pluck('total_harga');

        $bulan = Pemesanan::select(DB::raw("MONTHNAME(tgl_pesan) as bulan"))
        ->groupBy(DB::raw("MONTHNAME(tgl_pesan)"))
        ->orderByRaw("Month(tgl_pesan)")
        ->pluck('bulan');

        return view('admin/dashboard',compact('income','digunakan','customer','admin','antrian','kamar','users','total_harga','bulan','belum','sedang'));
    }
}
