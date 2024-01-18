<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengurusController extends Controller
{
    public function daftar_pengurus( )
    {
        return view('admin/pengurus', [
            'title' => 'Daftar Pengurus',
            'pengurus'=> Pengurus::all(),
        ]);
    }

    public function tambah_pengurus(Request $request)
    {
        $pengurus=new Pengurus;
        $pengurus->nama_pengurus=$request->nama_pengurus;
        $pengurus->jabatan=$request->jabatan;
        $pengurus->save();

        return redirect('/daftar_pengurus')->with("tambah_pengurus","Tambah Pengurus Berhasil!");
    }

    public function delete_pengurus($id)
    {
        Pengurus::find($id)->delete();
        return redirect()->back()->with("delete_pengurus","Data Pengurus Berhasil di Hapus!");
    }

    public function update_pengurus($id)
    {
        return view('admin/update/update_pengurus', [
            'title' => 'Update Pengurus',
            'pengurus'=> Pengurus::find($id),
        ]);
    }

    public function edit_pengurus($id, Request $request)
    {
        $pengurus = Pengurus::find($id);
        $pengurus->update($request->only(['nama_pengurus','jabatan']));
        if ($pengurus->save()){
            return redirect('/daftar_pengurus')->with('edit_pengurus', 'Data Pengurus Berhasil Diupdate');
        }
    }
}
