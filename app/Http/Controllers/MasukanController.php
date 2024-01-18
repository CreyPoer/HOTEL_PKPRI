<?php

namespace App\Http\Controllers;

use App\Models\Aktor;
use App\Models\Masukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }
    public function masukan()
    {
        $Masukan = Masukan::all();
        $terdapat = count($Masukan);
        return view('admin.masukan', compact('terdapat','Masukan'));
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
            'nama'   => 'required',
            'email' => 'required|email',
            'subjek' => 'required|not_in:""',
            'feedback' => 'required',
        ]);
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        $data['nama'] = $request->nama;
        $data['email'] = $request->email;
        $data['subjek'] = $request->subjek;
        $data['feedback'] = $request->feedback;

        Masukan::create($data);
        return redirect('/home')->with('succes', 'TERIMA KASIH atas masukan anda terkait pelayanan dan penawaran kami');
    }
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'subjek' => 'required|not_in:""',
            'feedback' => 'required',
        ]);
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        $data['nama'] = $request->nama;
        $data['email'] = $request->email;
        $data['subjek'] = $request->subjek;
        $data['feedback'] = $request->feedback;

        $aktor = Aktor::where('nama',$request->nama)->first();
        $id=$aktor->id;

        Masukan::create($data);
        return redirect('/pelanggan/'.$id)->with('succes', 'TERIMA KASIH atas masukan anda terkait pelayanan dan penawaran kami');
    }

    /**
     * Display the specified resource.
     */
    public function show(Masukan $masukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Masukan $masukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Masukan $masukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Masukan $masukan)
    {
        //
    }
}
