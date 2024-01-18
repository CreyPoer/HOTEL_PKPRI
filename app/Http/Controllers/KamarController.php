<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Aktor;
use App\Models\Kamar;
use App\Models\Pemesanan;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,$id)
    {
        $semuaKamar = Kamar::all();
        $dataKamar = [];
        $kategoriKamar = []; // Menyimpan kategori-kategori unik
        $jenis_kamar = []; // Menyimpan kategori-kategori unik

        foreach ($semuaKamar as $kamar) {
            $testimonis = Testimoni::where('kamar_id', $kamar->id)->get();

            $jumlahTestimoni = $testimonis->count();
            $totalRating = $testimonis->sum('rating');
            $rataRating = $jumlahTestimoni > 0 ? $totalRating / $jumlahTestimoni : 0;
            $kategori = $kamar->kategori_kamar;
            $jenis = $kamar->jenis_kamar;
             // Tambahkan kategori ke dalam array jika belum ada
            if (!in_array($kategori, $kategoriKamar)) {
                $kategoriKamar[] = $kategori;
            }
            if (!in_array($jenis, $jenis_kamar)) {
                $jenis_kamar[] = $jenis;
            }

            $dataKamar[] = [
                'kamar' => $kamar,
                'rata_rating' => $rataRating,
            ];
        }
        $jumlahPemesananPelanggan=Pemesanan::where('pelanggan_id',$id)
        ->where('status_pembayaran','Belum Bayar')->get();

        $jumlah=count($jumlahPemesananPelanggan);
        $home=1;

        return view('pelanggan.halamanpelanggan', compact('home','dataKamar','jumlah','kategoriKamar','jenis_kamar'));

    }
    public function lihatkategori(Request $request,$namakamar){
        $semuaKamar = Kamar::all();
        $KamarTertentu = Kamar::where('kategori_kamar',$namakamar)->get();
        $kategoriKamar = []; // Menyimpan kategori-kategori unik
        $jeniskamar=[];

        foreach ($semuaKamar as $kamar) {
            $testimonis = Testimoni::where('kamar_id', $kamar->id)->get();

            $jumlahTestimoni = $testimonis->count();
            $totalRating = $testimonis->sum('rating');
            $rataRating = $jumlahTestimoni > 0 ? $totalRating / $jumlahTestimoni : 0;
            $kategori = $kamar->kategori_kamar;
            $jenis = $kamar->jenis_kamar;

             // Tambahkan kategori ke dalam array jika belum ada
             if (!in_array($kategori, $kategoriKamar)) {
                $kategoriKamar[] = $kategori;
            }
             if (!in_array($jenis, $jeniskamar)) {
                $jeniskamar[] = $jenis;
            }

            $dataKamar[] = [
                'kamar' => $kamar,
                'rata_rating' => $rataRating,
            ];
        }
        $status=0;
        $home=0;
        return view('pelanggan.kamarhome', compact('home','status','KamarTertentu','kategoriKamar','jeniskamar'));
    }
    public function lihatkategoripelanggan(Request $request,$namakamar,$id){
        $semuaKamar = Kamar::all();
        $KamarTertentu = Kamar::where('kategori_kamar',$namakamar)->get();
        $kategoriKamar = []; // Menyimpan kategori-kategori unik
        $jeniskamar=[];

        foreach ($semuaKamar as $kamar) {
            $testimonis = Testimoni::where('kamar_id', $kamar->id)->get();

            $jumlahTestimoni = $testimonis->count();
            $totalRating = $testimonis->sum('rating');
            $rataRating = $jumlahTestimoni > 0 ? $totalRating / $jumlahTestimoni : 0;
            $kategori = $kamar->kategori_kamar;
            $jenis = $kamar->jenis_kamar;

             // Tambahkan kategori ke dalam array jika belum ada
             if (!in_array($kategori, $kategoriKamar)) {
                $kategoriKamar[] = $kategori;
            }
             if (!in_array($jenis, $jeniskamar)) {
                $jeniskamar[] = $jenis;
            }

            $dataKamar[] = [
                'kamar' => $kamar,
                'rata_rating' => $rataRating,
            ];
        }
        $jumlahPemesananPelanggan=Pemesanan::where('pelanggan_id',$id)
        ->where('status_pembayaran','Belum Bayar')->get();

        $status=0;
        $home=0;

        $jumlah=count($jumlahPemesananPelanggan);
        return view('pelanggan.kamarpelanggan', compact('home','status','KamarTertentu','jumlah','kategoriKamar','jeniskamar'));

    }
    public function tampil()
    {
        $semuaKamar = Kamar::all();
        $dataKamar = [];
        $kategoriKamar = []; // Menyimpan kategori-kategori unik
        $jeniskamar=[];

        foreach ($semuaKamar as $kamar) {
            $testimonis = Testimoni::where('kamar_id', $kamar->id)->get();
            $jumlahTestimoni = $testimonis->count();
            $totalRating = $testimonis->sum('rating');
            $rataRating = $jumlahTestimoni > 0 ? $totalRating / $jumlahTestimoni : 0;

            $kategori = $kamar->kategori_kamar;
            $jenis = $kamar->jenis_kamar;

            // Tambahkan kategori ke dalam array jika belum ada
            if (!in_array($kategori, $kategoriKamar)) {
                $kategoriKamar[] = $kategori;
            }
            if (!in_array($jenis, $jeniskamar)) {
                $jeniskamar[] = $jenis;
            }

            $dataKamar[] = [
                'kamar' => $kamar,
                'rata_rating' => $rataRating,
            ];
            $home=1;
        }

        return view('pelanggan.homepage', compact('home','dataKamar','kategoriKamar','jeniskamar'));
    }
    public function tampilsemua()
    {
        $semuaKamar = Kamar::all();
        $dataKamar = [];

        foreach ($semuaKamar as $kamar) {
            $testimonis = Testimoni::where('kamar_id', $kamar->id)->get();

            $jumlahTestimoni = $testimonis->count();
            $totalRating = $testimonis->sum('rating');
            $rataRating = $jumlahTestimoni > 0 ? $totalRating / $jumlahTestimoni : 0;

            $dataKamar[] = [
                'kamar' => $kamar,
                'rata_rating' => $rataRating,
            ];
        }
        $home=0;

        return view('kamarpelanggan', compact('home','dataKamar'));
    }

    public function kamar(Request $request,$status){
        $semuaKamar = Kamar::all();
        $dataKamar = [];

        foreach ($semuaKamar as $kamar) {
            $testimonis = Testimoni::where('kamar_id', $kamar->id)->get();
            $Kamarpesanan = Pemesanan::where('kamar_id', $kamar->id)->get();

            $jumlahTestimoni = $testimonis->count();
            $jumlahPesanan = $Kamarpesanan->count();
            $totalRating = $testimonis->sum('rating');
            $rataRating = $jumlahTestimoni > 0 ? $totalRating / $jumlahTestimoni : 0;

            $dataKamar[] = [
                'kamar' => $kamar,
                'rata_rating' => $rataRating,
                'jumlahpesanan' => $jumlahPesanan,
                'jumlahtestimoni' => $jumlahTestimoni,
            ];
        }
        $terdapat = count($dataKamar);
        return view('admin.kamar', compact('terdapat','status','dataKamar'));

    }

    public function detailkamarnama($nama,$id)
    {
        $dataKamar = Kamar::where('jenis_kamar',$nama)->get();
        $dtKamar = [];
        $tanggalHariIni = now()->format('Y-m-d'); // Mendapatkan tanggal hari ini
        $check =1;

        $kategoriKamar = []; // Menyimpan kategori-kategori unik

        $semuaKamar = Kamar::all();
        foreach ($semuaKamar as $kamar) {
            $kategori = $kamar->kategori_kamar;
            $jenis = $kamar->jenis_kamar;

            // Tambahkan kategori ke dalam array jika belum ada
            if (!in_array($kategori, $kategoriKamar)) {
                $kategoriKamar[] = $kategori;
            }
        }

        $jumlahPemesananPelanggan=Pemesanan::where('pelanggan_id',$id)
        ->where('status_pembayaran','Belum Bayar')->get();

        $jumlah=count($jumlahPemesananPelanggan);


        foreach ($dataKamar as $kamar) {
            $testimonis = Testimoni::where('kamar_id', $kamar->id)->get();

            $jumlahTestimoni = $testimonis->count();
            $totalRating = $testimonis->sum('rating');
            $rataRating = $jumlahTestimoni > 0 ? $totalRating / $jumlahTestimoni : 0;

            $dtKamar[] = [
                'kamar' => $kamar,
                'rata_rating' => $rataRating,
            ];

        }
        $home=0;
        return view('pelanggan.halamanpesankamarpelanggan', compact('home','jumlah','kategoriKamar','dtKamar','tanggalHariIni','check','nama'));

    }

    public function ceketersediaan(Request $request){
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        $jenis_kamar = $request->input('jenis_kamar');
        $id = $request->input('id');

        $kategori = Kamar::where('jenis_kamar', $jenis_kamar)->first();

        $idkamar = $kategori->id;
        $jumlahPemesananjeniskamar = Pemesanan::where('kamar_id', $idkamar)
        ->whereBetween('check_in', [$checkin, $checkout])
        ->sum('jumlah_kamar');

        $kapasitas = Kamar::where('jenis_kamar', $jenis_kamar)->first();
        $kapasitaskamar = $kapasitas->ketersediaan;
        $totaltersedia = $kapasitaskamar - $jumlahPemesananjeniskamar;

        $dataKamar = Kamar::where('jenis_kamar',$jenis_kamar)->get();
        $dtKamar = [];
        $tanggalHariIni = now()->format('Y-m-d'); // Mendapatkan tanggal hari ini
        $kategoriKamar = []; // Menyimpan kategori-kategori unik

        $semuaKamar = Kamar::all();
        foreach ($semuaKamar as $kamar) {
            $kategori = $kamar->kategori_kamar;
            $jenis = $kamar->jenis_kamar;

            // Tambahkan kategori ke dalam array jika belum ada
            if (!in_array($kategori, $kategoriKamar)) {
                $kategoriKamar[] = $kategori;
            }
        }

        $jumlahPemesananPelanggan=Pemesanan::where('pelanggan_id',$id)
        ->where('status_pembayaran','Belum Bayar')->get();

        $jumlah=count($jumlahPemesananPelanggan);

        foreach ($dataKamar as $kamar) {
            $testimonis = Testimoni::where('kamar_id', $kamar->id)->get();

            $jumlahTestimoni = $testimonis->count();
            $totalRating = $testimonis->sum('rating');
            $rataRating = $jumlahTestimoni > 0 ? $totalRating / $jumlahTestimoni : 0;

            $dtKamar[] = [
                'kamar' => $kamar,
                'rata_rating' => $rataRating,
            ];

        }
        // Query SQL untuk menghitung selisih hari
        $result = DB::select("SELECT DATEDIFF('$checkout', '$checkin') AS selisih_hari");

        // Ambil hasil selisih hari dari hasil query
        $selisihHari = $result[0]->selisih_hari;

        $nama=$jenis_kamar;
        if($totaltersedia>0){
            $check=0;
            $home=0;
            return view('pelanggan.halamanpesankamarpelanggan', compact('home','selisihHari','jumlah','kategoriKamar','dtKamar','tanggalHariIni','check','nama','totaltersedia','checkin','checkout'));
        }else{
            $checkin = Carbon::createFromFormat('Y-m-d', $checkin)->translatedFormat('d F Y');
            $checkout = Carbon::createFromFormat('Y-m-d', $checkout)->translatedFormat('d F Y');
            $check=2;
            $home=0;
            return view('pelanggan.halamanpesankamarpelanggan', compact('home','jumlah','kategoriKamar','dtKamar','tanggalHariIni','check','nama','totaltersedia','checkin','checkout'));
        }
    }
    public function ceketersediaan2(Request $request){
        $semuaKamar = Kamar::all();
        $jenis_kamar = $request->input('jenis_kamar');
        $id_pelanggan = $request->input('id_pelanggan');
        $request->validate(
            [
                'checkin' => 'required',
                'checkout' => 'required',
            ],
            [
                'checkin.required' => 'Tanggal Check In wajib diisi',
                'checkout.required' => 'Tanggal Check Out wajib diisi',
            ]
        );
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');

        $jumlahPemesananPelanggan=Pemesanan::where('pelanggan_id',$id_pelanggan)
        ->where('status_pembayaran','Belum Bayar')->get();

        $jumlah=count($jumlahPemesananPelanggan);

        if($jenis_kamar=="kosong") {
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

            $kamarsss = Kamar::where('ketersediaan', '>', 0)->get();

            $result = [];

            foreach ($kamarsss as $kamar) {
                $jumlahPemesanan = Pemesanan::where('kamar_id', $kamar->id)
                    ->whereBetween('check_in', [$checkin, $checkout])
                    ->count();

                $kamarData = [
                    'jenis_kamar' => $kamar->jenis_kamar,
                    'ketersediaan' => $kamar->ketersediaan - $jumlahPemesanan,
                    'harga_permalam' => $kamar->harga_permalam,
                ];

                $roomAvailability[] = $kamarData;
            }

            $jkamar="Semua Jenis Kamar";

            $pakejeniskamar=0;
            $status=1;
            $home=0;
            return view('pelanggan.kamarpelanggan', compact('home','status','pakejeniskamar','roomAvailability','jkamar','jumlah','kategoriKamar','checkin','checkout'));
        }else{
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
            $kamar = Kamar::where('jenis_kamar', $jenis_kamar)->first();
            $jkamar = $request->jenis_kamar;
            $id_kamar = $kamar->id;
            $jumlahPemesananjeniskamar = Pemesanan::where('kamar_id', $id_kamar)
            ->whereBetween('check_in', [$checkin, $checkout])
            ->sum('jumlah_kamar');

            $pakejeniskamar=1;
            $status=1;
            $home=0;

            $kapasitaskamar = $kamar->ketersediaan;
            $totaltersedia = $kapasitaskamar - $jumlahPemesananjeniskamar;
            return view('pelanggan.kamarpelanggan', compact('home','status','pakejeniskamar','totaltersedia','kamar','jkamar','jumlah','kategoriKamar','checkin','checkout'));
        }
    }
    public function ceketersediaan3(Request $request){
        $semuaKamar = Kamar::all();
        $jenis_kamar = $request->input('jenis_kamar');
        $id_pelanggan = $request->input('id_pelanggan');
        $request->validate(
            [
                'checkin' => 'required',
                'checkout' => 'required',
            ],
            [
                'checkin.required' => 'Tanggal Check In wajib diisi',
                'checkout.required' => 'Tanggal Check Out wajib diisi',
            ]
        );
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        if($jenis_kamar=="kosong") {
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
            if($checkin==null && $checkout==null){
                $roomAvailability[] = $semuaKamar;
                $jkamar="Semua Jenis Kamar";
                $pakejeniskamar=0;
                $status=1;
                $home=0;
                return view('pelanggan.kamarhome', compact('home','status','pakejeniskamar','roomAvailability','jkamar','kategoriKamar','checkin','checkout'));
            }else{
                $kamarsss = Kamar::where('ketersediaan', '>', 0)->get();
                $result = [];
                foreach ($kamarsss as $kamar) {
                    $jumlahPemesanan = Pemesanan::where('kamar_id', $kamar->id)
                        ->whereBetween('check_in', [$checkin, $checkout])
                        ->count();

                    $kamarData = [
                        'jenis_kamar' => $kamar->jenis_kamar,
                        'image' => $kamar->image,
                        'ketersediaan' => $kamar->ketersediaan - $jumlahPemesanan,
                        'harga_permalam' => $kamar->harga_permalam,
                    ];

                    $roomAvailability[] = $kamarData;
                }
                $jkamar="Semua Jenis Kamar";
                $pakejeniskamar=0;
                $status=1;
                $home=0;
                return view('pelanggan.kamarhome', compact('home','status','pakejeniskamar','roomAvailability','jkamar','kategoriKamar','checkin','checkout'));
            }

        }else{
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
            $kamar = Kamar::where('jenis_kamar', $jenis_kamar)->first();
            $jkamar = $request->jenis_kamar;
            $id_kamar = $kamar->id;
            $jumlahPemesananjeniskamar = Pemesanan::where('kamar_id', $id_kamar)
            ->whereBetween('check_in', [$checkin, $checkout])
            ->sum('jumlah_kamar');

            $pakejeniskamar=1;
            $status=1;
            $home=0;

            $kapasitaskamar = $kamar->ketersediaan;
            $totaltersedia = $kapasitaskamar - $jumlahPemesananjeniskamar;
            return view('pelanggan.kamarhome', compact('home','status','pakejeniskamar','totaltersedia','kamar','jkamar','kategoriKamar','checkin','checkout'));
        }
    }
    public function resetceketersediaan(Request $request,$id){
        $KamarTertentu = Kamar::all();
        $jumlahPemesananPelanggan=Pemesanan::where('pelanggan_id',$id)
        ->where('status_pembayaran','Belum Bayar')->get();

        $jumlah=count($jumlahPemesananPelanggan);

        $kategoriKamar = []; // Menyimpan kategori-kategori unik
        $jeniskamar=[];

        foreach ($KamarTertentu as $kamar) {
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
        $status=0;
        $home=0;
        return view('pelanggan.kamarpelanggan', compact('home','status','KamarTertentu','jumlah','kategoriKamar','jeniskamar'));
    }

    public function resetceketersediaan2(){
        $KamarTertentu = Kamar::all();

        $kategoriKamar = []; // Menyimpan kategori-kategori unik
        $jeniskamar=[];

        foreach ($KamarTertentu as $kamar) {
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
        $status=0;
        $home=0;
        return view('pelanggan.kamarhome', compact('home','status','KamarTertentu','kategoriKamar','jeniskamar'));
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

        $validator = Validator::make($request->all(),[
            'jenis_kamar' => 'required',
            'harga_permalam'   => 'required',
            'kapasitas' => 'required',
            'bed' => 'required',
            'pendingin_ruangan' => 'required',
            'tv' => 'required',
            'kamar_mandi'   => 'required',
            'peralatan_mandi' => 'required',
            'breakfast' => 'required',
            'ketersediaan' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg',
        ]);
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $image=$request->file('image');
        $filename = $request->jenis_kamar.'.'.$image->getClientOriginalExtension();
        $path='image-kamar/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($image));

        $data['jenis_kamar'] = $request->jenis_kamar;
        $data['harga_permalam'] = $request->harga_permalam;
        $data['kapasitas'] = $request->kapasitas;
        $data['bed'] = $request->bed;
        $data['pendingin_ruangan'] = $request->pendingin_ruangan;
        $data['tv'] = $request->tv;
        $data['kamar_mandi'] = $request->kamar_mandi;
        $data['peralatan_mandi'] = $request->peralatan_mandi;
        $data['breakfast'] = $request->breakfast;
        $data['ketersediaan'] = $request->ketersediaan;
        $data['image'] = $filename;

        Kamar::create($data);
        $id=0;


        // Aktor::whereId($id)->update($data);
        // Session::flash('success', 'Profil berhasil diperbarui!');
        return redirect('/kamar/'. $id)->with('succes', 'Data Berhasil Ditambahkan ke database');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar,$status,$id)
    {
        $Kamartertentu = Kamar::where('id',$id)->first();
        $semuaKamar = Kamar::all();
        $dataKamar = [];

        foreach ($semuaKamar as $kamar) {
            $testimonis = Testimoni::where('kamar_id', $kamar->id)->get();

            $jumlahTestimoni = $testimonis->count();
            $totalRating = $testimonis->sum('rating');
            $rataRating = $jumlahTestimoni > 0 ? $totalRating / $jumlahTestimoni : 0;

            $dataKamar[] = [
                'kamar' => $kamar,
                'rata_rating' => $rataRating,
            ];
        }


        return view('admin.kamar', compact('status','dataKamar','Kamartertentu'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar, $id)
    {
        $ubah = Kamar::findOrFail($id);
        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(),[
                'jenis_kamar' => 'required',
                'harga_permalam'   => 'required',
                'kapasitas' => 'required',
                'bed' => 'required',
                'pendingin_ruangan' => 'required',
                'tv' => 'required',
                'kamar_mandi'   => 'required',
                'peralatan_mandi' => 'required',
                'breakfast' => 'required',
                'ketersediaan' => 'required',
            ]);
            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

            $file = $request->file('image');
            $filename =  $ubah->image;
            if($filename!=null){
             // $filename = $request->jenis_kamar.$file->getClientOriginalExtension();
                $path='image-kamar/'.$filename;
                $oldImage = public_path('image-kamar') . '/' . $filename;
                if (File::exists($oldImage)) {
                    File::delete($oldImage); // Menghapus file lama
                }
                Storage::disk('public')->put($path,file_get_contents($file));

            }else{
                $filename = $request->jenis_kamar.'.'.$file->getClientOriginalExtension();
                $path='image-kamar/'.$filename;
                Storage::disk('public')->put($path,file_get_contents($file));
            }
            // Update kolom 'image' dengan nama file yang baru di database

            $data['jenis_kamar'] = $request->jenis_kamar;
            $data['harga_permalam'] = $request->harga_permalam;
            $data['kapasitas'] = $request->kapasitas;
            $data['bed'] = $request->bed;
            $data['pendingin_ruangan'] = $request->pendingin_ruangan;
            $data['tv'] = $request->tv;
            $data['kamar_mandi'] = $request->kamar_mandi;
            $data['peralatan_mandi'] = $request->peralatan_mandi;
            $data['breakfast'] = $request->breakfast;
            $data['ketersediaan'] = $request->ketersediaan;
            $data['image'] = $filename;
            Kamar::whereId($id)->update($data);
        } else {
            $validator = Validator::make($request->all(),[
                'jenis_kamar' => 'required',
                'harga_permalam'   => 'required',
                'kapasitas' => 'required',
                'bed' => 'required',
                'pendingin_ruangan' => 'required',
                'tv' => 'required',
                'kamar_mandi'   => 'required',
                'peralatan_mandi' => 'required',
                'breakfast' => 'required',
                'ketersediaan' => 'required',
            ]);
            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
            $data['jenis_kamar'] = $request->jenis_kamar;
            $data['harga_permalam'] = $request->harga_permalam;
            $data['kapasitas'] = $request->kapasitas;
            $data['bed'] = $request->bed;
            $data['pendingin_ruangan'] = $request->pendingin_ruangan;
            $data['tv'] = $request->tv;
            $data['kamar_mandi'] = $request->kamar_mandi;
            $data['peralatan_mandi'] = $request->peralatan_mandi;
            $data['breakfast'] = $request->breakfast;
            $data['ketersediaan'] = $request->ketersediaan;
            Kamar::whereId($id)->update($data);
        }
        // Session::flash('success', 'Profil berhasil diperbarui!');
        $status=0;
        return redirect('/kamar/'. $status)->with('succesUpdate', 'Data Berhasil DiUpdate ke Database');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar,$id)
    {
         // Temukan data kamar yang akan dihapus
        try {
            $kamar = Kamar::findOrFail($id);
            $kamar->pemesanan()->delete();
            $kamar->testimoni()->delete();
            $kamar->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1451) {
                // Tampilkan pesan kepada pengguna bahwa ada ketergantungan data
                return redirect()->back()->with('errortidakdapathapus', 'Tidak dapat menghapus karena data jenis kamar yang akan dihapus ini telah terkait dengan tabel pembayaran melalui tabel pemesanan pelanggan.');
            }else{
                $kamar = Kamar::findOrFail($id);
                if ($kamar->image) {
                    $filePath = 'public/image-kamar/' . $kamar->image;
                    if (Storage::exists($filePath)) {
                        Storage::delete($filePath);
                    }
                }
            }
        }
         $status=0;
         return redirect('/kamar/'. $status)->with('succesHapus', 'Data kamar berhasil dihapus dari database');


     }
}
