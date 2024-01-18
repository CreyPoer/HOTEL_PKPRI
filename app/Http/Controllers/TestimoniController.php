<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pemesanan;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimoniController extends Controller
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
        $id_pemesanan = $request->input('id_pemesanan');
        $pelanggan_id = $request->input('pelanggan_id');
        $kamar_id = $request->input('kamar_id');
        $rating = $request->input('inlineRadioOptions');
        $ulasan = $request->input('ulasan');

        Testimoni::create([
            'pelanggan_id' => $pelanggan_id,
            'kamar_id' => $kamar_id,
            'rating' => $rating,
            'ulasan' => $ulasan
        ]);

        Pemesanan::where('id', $id_pemesanan)->update(['status_ulasan' => 'Sudah Diulas']); // Mengasumsikan status_ulasan adalah boolean
        return redirect('/pesananpelanggan/'. $pelanggan_id)->with('berhasilmengulas', 'Terima kasih telah memberikan masukan anda terkait jenis kamar yang kami sediakan untuk anda');


    }

    /**
     * Display the specified resource.
     */
    public function testimoni()
    {
        $Testimoni = Testimoni::all();
        $terdapat = count($Testimoni);

        $namaAktors = [];
        foreach ($Testimoni as $testimoni) {
            // Misalnya 'nama' adalah nilai default untuk aktor jika tidak ada yang lain
            $namaAktor = $testimoni->aktor['nama'] ?? 'nama';
            $namaAktors[] = $namaAktor;
        }

        return view('admin.testimoni', compact('terdapat', 'Testimoni', 'namaAktors'));
    }

    public function test(){
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

        return view('pelanggan.homepage', compact('dataKamar'));
    }

    public function show(Testimoni $testimoni)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $testimoni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $testimoni)
    {
        //
    }
}
