<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    // untuk yg belum login
    public function info_pembayaran()
    {
        return view('rekening', [
            'title' => 'rekening',
            'bayar' => Rekening::all(),
        ]);
    }

    // untuk yg sudah login
    public function hal_info_pembayaran()
    {
        return view('rekening', [
            'title' => 'rekening',
            'bayar' => Rekening::all(),
        ]);
    }

    public function daftar_pembayaran()
    {
        return view('admin/rekening', [
            'title' => 'Rekening',
            'rekening' => Rekening::all(),
        ]);
    }

    public function tambah_pembayaran(Request $request)
    {
        $rekening=new Rekening;
        $rekening->rek_tujuan=$request->rek_tujuan;
        $rekening->no_rek_tujuan=$request->no_rek_tujuan;
        $rekening->atas_nama=$request->atas_nama;
        $rekening->save();

        return redirect('/daftar_pembayaran')->with("tambah_pembayaran","Tambah Nomor Rekening Berhasil!");
    }

    public function delete_pembayaran($id)
    {
        Rekening::find($id)->delete();
        return redirect()->back()->with("delete_pembayaran","Nomor Rekening Berhasil di Hapus");
    }


    public function update_pembayaran($id)
    {
        return view('admin/update/update_rekening', [
            'title' => 'Update Rekening',
            'rekening'=> Rekening::find($id),
        ]);
    }

    public function edit_pembayaran($id, Request $request)
    {
        $paket = Rekening::find($id);
        $paket->update($request->except(['token', 'submit']));
        if ($paket->save()){
            return redirect('/daftar_pembayaran')->with('edit_pembayaran', 'Nomor Rekening Berhasil Diupdate');
        }
    }
}
