<?php

namespace App\Http\Controllers;

use App\Models\Aktor;
use App\Models\Kamar;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AktorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'email wajib diisi',
                'password.required' => 'password wajib diisi',
            ]
        );

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            // Jika berhasil login, dapatkan role pengguna
            $role = Auth::user()->role;
            $id = Auth::user()->id;

            // Arahkan pengguna berdasarkan peran (role)
            if ($role == 'Admin') {
                return redirect('/homeadmin');
            } elseif ($role == 'Pelanggan') {
                return redirect('/pelanggan/'.$id);
            } else {
                // Tambahkan logika lain jika ada peran lainnya
                return redirect('/home');
            }
        } else {
            return back()->with('loginError', 'Login Gagal, Silahkan Masukkan Username dan Password yang Benar! Jika belum
            memiliki akun silahkan klik <a class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#Daftar" href="#" id="daftarLink"> Daftar</a> terlebih dahulu! ');
        }
    }

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

    public function tampil($id)
    {
        $dataPelanggan = Aktor::where('id',$id)->get();

        $KamarTertentu = Kamar::all();
        $jumlahPemesananPelanggan=Pemesanan::where('pelanggan_id',$id)
        ->where('status_pembayaran','Belum Bayar')->get();

        $jumlah=count($jumlahPemesananPelanggan);

        $kategoriKamar = []; // Menyimpan kategori-kategori unik

        foreach ($KamarTertentu as $kamar) {
            $kategori = $kamar->kategori_kamar;
            $jenis = $kamar->jenis_kamar;

            // Tambahkan kategori ke dalam array jika belum ada
            if (!in_array($kategori, $kategoriKamar)) {
                $kategoriKamar[] = $kategori;
            }
        }
        $status=0;
        $home=0;
        return view('pelanggan.profilpelanggan', compact('home','dataPelanggan','status','jumlah','kategoriKamar'));

    }
    public function lihat()
    {
        $dataPelanggan = Aktor::where('role','Pelanggan')->get();
        $terdapat = count($dataPelanggan);
        return view('admin.pelanggan', compact('terdapat','dataPelanggan'));
    }

    public function akuncustomer()
    {
        return view('admin/pelanggan', [
            'title' => 'Akun Customer',
            'cust'=> Aktor::all(),
        ]);
    }

    //admin
    public function akunadmin()
    {
        return view('admin/admin', [
            'title' => 'Akun Admin',
            'admin'=> Aktor::all(),
        ]);
    }

    public function tambah_akun(Request $request)
    {
        // $user=new aktor;
        // $user->nama=$request->nama;
        // $user->alamat=$request->alamat;
        // $user->no_hp=$request->no_telp;
        // $user->email=$request->email;
        // $user->password=$request->password;
        // $user->role=$request->role;
        // $user->save();

        $data['no_ktp'] = $request->no_ktp;
        $data['nama'] = $request->nama;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['alamat'] = $request->alamat;
        $data['no_telp'] = $request->no_telp;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['role'] = 'Admin';

        $hashedPassword = bcrypt($request->password);
        $data2['name'] = $request->nama;
        $data2['email'] = $request->email;
        $data2['password'] = $hashedPassword;
        $data2['role'] = 'Admin';

        Aktor::create($data);
        User::create($data2);

        $admin=Aktor::where('role','Admin')->get();

        return view('admin/admin',compact('admin'))->with('tambah_akun','Daftar Berhasil, Silahkan Login untuk Melakukan Pemesanan!');

        // return redirect('/akunadmin')->with('tambah_admin','Daftar Berhasil, Silahkan Login untuk Melakukan Pemesanan!');
    }

    public function delete_akun($id)
    {
        Aktor::find($id)->delete();
        return redirect()->back()->with("delete_akun","Akun Berhasil di Hapus");
    }

    public function update_akun($id)
    {
        return view('admin/update/update_admin', [
            'title' => 'Update user',
            'aktor'=> Aktor::find($id)
        ]);
    }

    public function edit_akun(Request $request)
    {
        $id=$request->id;
        $data['no_ktp'] = $request->no_ktp;
        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['no_telp'] = $request->no_telp;
        $data['email'] = $request->email;
        $data['password'] = $request->password;

        $hashedPassword = bcrypt($request->password);
        $datas['name'] = $request->nama;
        $datas['email'] = $request->email;
        $datas['password'] = $hashedPassword;

        Aktor::whereId($id)->update($data);
        User::whereId($id)->update($datas);

        // $user= Aktor::find($request->id);
        // $user->nama=$request->nama;
        // $user->email=$request->email;
        // $user->no_hp=$request->no_telp;
        // $user->alamat=$request->alamat;
        // $user->save();

        return redirect('/akunadmin')->with("update_akun","Berhasil Diupdate!");

        // return redirect('/akunadmin')->with("update_admin","Berhasil Diupdate!");
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'no_ktp' => 'required',
                'nama' => 'required',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'no_telp' => 'required',
                'alamat' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'image' => 'required|image|mimes:jpeg,jpg,png',
            ],
            [
                'no_ktp.required' => 'nomer ktp wajib diisi',
                'nama.required' => 'nama anda wajib diisi',
                'jenis_kelamin.required' => 'jenis kelamin anda wajib diisi',
                'no_telp.required' => 'nomor telpon anda wajib diisi',
                'alamat.required' => 'alamat anda wajib diisi',
                'email.required' => 'email wajib diisi',
                'password.required' => 'password wajib diisi',
                'password.min' => 'password yang dimasukkan setidaknya terdiri dari lebih dari 6 karakter',
                'image.required' => 'gambar diri anda wajib diupload',
                'image.image' => 'file yang diupload harus berupa file gambar',
                'image.mimes' => 'file yang upload harus berekstensi jpeg, jpg atau png',
            ]
        );
        // if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        $image=$request->file('image');
        $filename = $request->no_ktp.'.'.$image->getClientOriginalExtension();
        $image->move(public_path('gambar-user'), $filename);
        // $path='image-pelanggan/'.$filename;
        // $path2='image-user/'.$filename;

        // Storage::disk('public')->put($path,file_get_contents($image));
        // Storage::disk('public')->put($path2,file_get_contents($image));
        $data['no_ktp'] = $request->no_ktp;
        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['no_telp'] = $request->no_telp;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['image'] = $filename;
        $data['role'] = 'Pelanggan';

        $hashedPassword = bcrypt($request->password);
        $data2['name'] = $request->nama;
        $data2['email'] = $request->email;
        $data2['password'] = $hashedPassword;
        $data2['image'] = $filename;
        $data2['role'] = 'Pelanggan';

        Aktor::create($data);
        User::create($data2);

        return redirect('/home')->with('succesLogin', 'Data diri anda berhasil didaftarkan, silahkan anda bisa masuk ke sistem sekarang');

    }

    /**
     * Display the specified resource.
     */
    public function show(Aktor $aktor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aktor $aktor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $ubah = Aktor::findOrFail($id);
        $filenames = null; // Initialize $filenames
        if ($request->hasFile('image')) {
            $request->validate(
                [
                    'no_ktp' => 'required',
                    'nama' => 'required',
                    'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                    'no_telp' => 'required',
                    'alamat' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|min:6',
                    'image' => 'required|image|mimes:jpeg,jpg,png',
                ],
                [
                    'no_ktp.required' => 'nomer ktp wajib diisi',
                    'nama.required' => 'nama anda wajib diisi',
                    'jenis_kelamin.required' => 'jenis kelamin anda wajib diisi',
                    'no_telp.required' => 'nomor telpon anda wajib diisi',
                    'alamat.required' => 'alamat anda wajib diisi',
                    'email.required' => 'email wajib diisi',
                    'password.required' => 'password wajib diisi',
                    'password.min' => 'password yang dimasukkan setidaknya terdiri dari lebih dari 6 karakter',
                    'image.required' => 'gambar diri anda wajib diupload',
                    'image.image' => 'file yang diupload harus berupa file gambar',
                    'image.mimes' => 'file yang upload harus berekstensi jpeg, jpg atau png',
                ]
            );
            $file = $request->file('image');
            $filename =  $ubah->image;
            if($filename!=null){
                unlink(public_path('gambar-user/' . $filename));
                $filename = $request->no_ktp.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('gambar-user'), $filename);

                // $path='image-pelanggan/'.$filename;
                // $path2='image-user/'.$filename;
                // $oldImage = public_path('image-pelanggan') . '/' . $filename;
                // if (File::exists($oldImage)) {
                //     File::delete($oldImage); // Menghapus file lama
                // }
                // $oldImage2 = public_path('image-pelanggan') . '/' . $filename;
                // if (File::exists($oldImage2)) {
                //     File::delete($oldImage2); // Menghapus file lama
                // }
                // Storage::disk('public')->put($path,file_get_contents($file));
                // Storage::disk('public')->put($path2,file_get_contents($file));

                $data['no_ktp'] = $request->no_ktp;
                $data['nama'] = $request->nama;
                $data['alamat'] = $request->alamat;
                $data['jenis_kelamin'] = $request->jenis_kelamin;
                $data['no_telp'] = $request->no_telp;
                $data['email'] = $request->email;
                $data['password'] = $request->password;
                $data['image'] = $filename;

                $hashedPassword = bcrypt($request->password);
                $datas['name'] = $request->nama;
                $datas['email'] = $request->email;
                $datas['password'] = $hashedPassword;
                $datas['image'] = $filename;

                Aktor::whereId($id)->update($data);
                User::whereId($id)->update($datas);

                // Session::flash('success', 'Profil berhasil diperbarui!');
                return redirect('/lihatprofil/'. $id)->with('succes', 'Data Berhasil Diupdate');

            }else{
                $filenames = $request->no_ktp.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('gambar-user'), $filenames);
                // $path='image-pelanggan/'.$filenames;
                // $path2='image-user/'.$filenames;
                // Storage::disk('public')->put($path,file_get_contents($file));
                // Storage::disk('public')->put($path2,file_get_contents($file));

                $data['no_ktp'] = $request->no_ktp;
                $data['nama'] = $request->nama;
                $data['alamat'] = $request->alamat;
                $data['jenis_kelamin'] = $request->jenis_kelamin;
                $data['no_telp'] = $request->no_telp;
                $data['email'] = $request->email;
                $data['password'] = $request->password;
                $data['image'] = $filenames;

                $hashedPassword = bcrypt($request->password);
                $datas['name'] = $request->nama;
                $datas['email'] = $request->email;
                $datas['password'] = $hashedPassword;
                $datas['image'] = $filenames;

                Aktor::whereId($id)->update($data);
                User::whereId($id)->update($datas);

                // Session::flash('success', 'Profil berhasil diperbarui!');
                return redirect('/lihatprofil/'. $id)->with('succes', 'Data Berhasil Diupdate');
            }
        }else{
            $request->validate(
                [
                    'no_ktp' => 'required',
                    'nama' => 'required',
                    'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                    'no_telp' => 'required',
                    'alamat' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|min:6',
                ],
                [
                    'no_ktp.required' => 'nomer ktp wajib diisi',
                    'nama.required' => 'nama anda wajib diisi',
                    'jenis_kelamin.required' => 'jenis kelamin anda wajib diisi',
                    'no_telp.required' => 'nomor telpon anda wajib diisi',
                    'alamat.required' => 'alamat anda wajib diisi',
                    'email.required' => 'email wajib diisi',
                    'password.required' => 'password wajib diisi',
                    'password.min' => 'password yang dimasukkan setidaknya terdiri dari lebih dari 6 karakter',
                ]
            );

        }
        $data['no_ktp'] = $request->no_ktp;
        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['no_telp'] = $request->no_telp;
        $data['email'] = $request->email;
        $data['password'] = $request->password;

        $datas['name'] = $request->nama;
        $datas['email'] = $request->email;
        $datas['password'] = $request->password;

        Aktor::whereId($id)->update($data);
        User::whereId($id)->update($datas);

        // Session::flash('success', 'Profil berhasil diperbarui!');
        return redirect('/lihatprofil/'. $id)->with('succes', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aktor $aktor)
    {
        //
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }
}
