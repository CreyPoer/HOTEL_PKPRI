<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnggotaController extends Controller
{
    public function anggota( )
    {
        return view('tentang', [
            'title' => 'Anggota',
            'anggota'=> Anggota::all(),
            'pengurus'=> Pengurus::all(),
        ]);
    }
    public function daftar_anggota( )
    {
        return view('admin/anggota', [
            'title' => 'Daftar Anggota',
            'anggota'=> Anggota::all(),
        ]);
    }

    public function tambah_anggota(Request $request)
    {
        $anggota=new Anggota;
        $anggota->nama_anggota=$request->nama_anggota;
        $anggota->no=$request->no;
        $anggota->tanggal=$request->tanggal;
        $anggota->pukul=$request->pukul;
        $anggota->keterangan=$request->keterangan;
        $anggota->save();

        return redirect('/daftar_anggota')->with("tambah_anggota","Tambah Anggota Berhasil!");
    }

    public function delete_anggota($id)
    {
        Anggota::find($id)->delete();
        return redirect()->back()->with("delete_anggota","Data Anggota Berhasil di Hapus!");
    }

    public function update_anggota($id)
    {
        return view('admin/update/update_anggota', [
            'title' => 'Update Anggota',
            'anggota'=> Anggota::find($id),
        ]);
    }

    public function edit_anggota($id, Request $request)
    {
        $anggota = Anggota::find($id);
        $anggota->update($request->only(['nama_anggota','no','tanggal','pukul','keterangan']));
        if ($anggota->save()){
            return redirect('/daftar_anggota')->with('edit_anggota', 'Data Anggota Berhasil Diupdate');
        }
    }
}
