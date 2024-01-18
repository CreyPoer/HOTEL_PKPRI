<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class PembayaranController extends Controller
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
    public function store(Request $request,$id)
    {
        $metode_pembayaran = $request->input('metode_pembayaran');
        $Pesanan = Pemesanan::where('id',$id)->first();
        $pelanggan_id = $Pesanan->pelanggan_id;

        if($metode_pembayaran=='ONLINE'){
            $request->validate(
                [
                    'bayar' => 'required',
                    'rek_asal' => 'required',
                    'no_rek_asal' => 'required',
                    'atas_nama' => 'required',
                    'bukti_transfer' => 'required|image|mimes:jpeg,jpg',
                ],
                [
                    'bayar.required' => 'silahkan pilih jenis bayar terlebih dahulu',
                    'rek_asal.required' => 'rekening bank yang anda gunakan wajib diisi',
                    'no_rek_asal.required' => 'nomer rekening bank yang anda gunakan wajib diisi',
                    'atas_nama.required' => 'nama rekening bank yang anda gunakan wajib diisi',
                    'bukti_transfer.required' => 'bukti transfer anda wajib diupload',
                    'bukti_transfer.image' => 'file bukti transfer yang diupload harus berupa file gambar',
                    'bukti_transfer.mimes' => 'file bukti transfer yang upload harus berekstensi jpeg atau jpg',
                ]
            );
            $tgl_bayar = $request->input('tgl_bayar');
            $jumlah_pembayaran = $request->input('jumlah_pembayaran');
            $rek_tujuan = $request->input('rek_tujuan');
            $no_rek_tujuan = $request->input('no_rek_tujuan');
            $rek_asal = $request->input('rek_asal');
            $no_rek_asal = $request->input('no_rek_asal');
            $atas_nama = $request->input('atas_nama');
            $bukti_transfer=$request->file('bukti_transfer');
            $bayar = $request->input('bayar');
            if($bayar=="FULL"){
                $filename = $bayar.$id.'.'.$bukti_transfer->getClientOriginalExtension();
                $path='image-buktitransfer/'.$filename;
                Pembayaran::create([
                    'pelanggan_id' => $pelanggan_id,
                    'pemesanan_id' => $id,
                    'tgl_bayar' => $tgl_bayar,
                    'metode_pembayaran' => $metode_pembayaran,
                    'jumlah_pembayaran' => $jumlah_pembayaran,
                    'rek_tujuan' => $rek_tujuan,
                    'no_rek_tujuan' => $no_rek_tujuan,
                    'rek_asal' => $rek_asal,
                    'no_rek_asal' => $no_rek_asal,
                    'atas_nama' => $atas_nama,
                    'bukti_transfer' => $filename,
                ]);

                $data['status_pembayaran'] = 'Menunggu Konfirmasi';
                Storage::disk('public')->put($path,file_get_contents($bukti_transfer));

                Pemesanan::whereId($id)->update($data);

                return redirect('/pesananpelanggan/'. $pelanggan_id)->with('berhasilbayaronline', 'Terima kasih telah mengkonfirmasi pembayaran anda, Selanjutnya akan kami konfirmasi pembayaran anda');

            }elseif($bayar=="DP"){
                $filename = $bayar.$id.'.'.$bukti_transfer->getClientOriginalExtension();
                $path='image-buktitransfer/'.$filename;
                $jumlah_dp = ($jumlah_pembayaran * 50) / 100;
                Pembayaran::create([
                    'pelanggan_id' => $pelanggan_id,
                    'pemesanan_id' => $id,
                    'tgl_bayar' => $tgl_bayar,
                    'metode_pembayaran' => $metode_pembayaran,
                    'jumlah_dp' => $jumlah_dp,
                    'rek_tujuan' => $rek_tujuan,
                    'no_rek_tujuan' => $no_rek_tujuan,
                    'rek_asal' => $rek_asal,
                    'no_rek_asal' => $no_rek_asal,
                    'atas_nama' => $atas_nama,
                    'bukti_transfer' => $filename,
                ]);
                Storage::disk('public')->put($path,file_get_contents($bukti_transfer));
                $data['status_pembayaran'] = 'Menunggu Konfirmasi';
                Pemesanan::whereId($id)->update($data);
                return redirect('/pesananpelanggan/'. $pelanggan_id)->with('berhasilbayaronline', 'Terima kasih telah mengkonfirmasi pembayaran anda, Selanjutnya akan kami konfirmasi pembayaran anda');

            }
        }elseif($metode_pembayaran=='OFFLINE'){
            $tenggatbayar = Carbon::now()->addHours(24);
            Pembayaran::create([
                'pelanggan_id' => $pelanggan_id,
                'pemesanan_id' => $id,
                'metode_pembayaran' => $metode_pembayaran,
            ]);
            $data['status_pembayaran'] = 'Menunggu Konfirmasi';
            $data['tenggat_bayar'] = $tenggatbayar;
            Pemesanan::whereId($id)->update($data);

            return redirect('/pesananpelanggan/'. $pelanggan_id)->with('berhasilbayaroffline', 'Terima kasih telah mengkonfirmasi pembayaran anda, Selanjutnya silahkan Anda melakukan pembayaran secara langsung dengan jangka waktu 1 x 24 jam dimulai dari sekarang');
        }
    }
    /**
     * Display the specified resource.
     */
    public function lihatkonfirmasioffline(){
        $pemesananDanPembayaran = Pemesanan::with('pembayaran')->whereHas('pembayaran', function($query) {
            $query->where('status_pembayaran', 'Menunggu Konfirmasi')
                  ->where('metode_pembayaran', 'OFFLINE');
        })->get();

        $terdapat = count($pemesananDanPembayaran);
        $status=0;
        return view('admin.konfirmasipembayaranoffline', compact('status','terdapat','pemesananDanPembayaran'));
    }

    public function validasipembayaranoffline(Request $request){
        $bayar = $request->bayar;
        $id=$request->id_pemesanan;
        if($bayar=="FULL"){
            $data['status_pembayaran'] = 'Sudah Bayar';
            $data['status_pesan'] = 'Aktif';
            Pemesanan::whereId($id)->update($data);

            $datas['jumlah_pembayaran']=$request->jumlah_pembayaran;
            Pembayaran::where('pemesanan_id',$id)->update($datas);
        }elseif($bayar=="DP"){
            $data['status_pembayaran'] = 'Masih DP';
            $data['status_pesan'] = 'Aktif';
            Pemesanan::whereId($id)->update($data);

            $datas['jumlah_dp']=$request->jumlah_pembayaran;
            Pembayaran::where('pemesanan_id',$id)->update($datas);
        }
        $pemesananDanPembayaran = Pemesanan::with('pembayaran')->whereHas('pembayaran', function($query) {
            $query->where('status_pembayaran', 'Menunggu Konfirmasi')
                  ->where('metode_pembayaran', 'OFFLINE');
        })->get();

        $terdapat = count($pemesananDanPembayaran);
        return view('admin.konfirmasipembayaranoffline', compact('terdapat','pemesananDanPembayaran'))->with('berhasilvalidasi','pembayaran offline pelanggan telah berhasil divalidasi');
    }

    public function validasihapuspembayaranoffline(Request $request){
        $id=$request->id_pemesanan;
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->pembayaran()->delete();
        $pemesanan->delete();

        $pemesananDanPembayaran = Pemesanan::with('pembayaran')->whereHas('pembayaran', function($query) {
            $query->where('status_pembayaran', 'Menunggu Konfirmasi')
                  ->where('metode_pembayaran', 'OFFLINE');
        })->get();

        $terdapat = count($pemesananDanPembayaran);
        return view('admin.konfirmasipembayaranoffline', compact('terdapat','pemesananDanPembayaran'))->with('berhasilhapusvalidasi','pembayaran offline pelanggan telah berhasil dihapus');
    }
    public function validasihapuspemesanan(Request $request){
        $id=$request->id_pemesanan;
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->pembayaran()->delete();
        $pemesanan->delete();

        $pelanggan_id=$pemesanan->pelanggan_id;
        return redirect('/pesananpelanggan/'. $pelanggan_id)->with('berhasilmenghapus','Data pemesanan kamar hotel anda telah berhasil di hapus ');
    }

    public function validasipembayaranfulldpofflinecheckin(Request $request){
        $id=$request->id_pemesanan;
        $jumlah_pembayaran=$request->jumlah_pembayaran;

        $data['status_pembayaran'] = 'Sudah Bayar';
        $data['status_checkin'] = 'Sedang Check-In';
        Pemesanan::whereId($id)->update($data);

        $datas['jumlah_pembayaran']=$jumlah_pembayaran;
        Pembayaran::where('pemesanan_id',$id)->update($datas);

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


    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}
