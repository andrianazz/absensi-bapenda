<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function addUser()
    {

        $unit_kerja = UnitKerja::where('id', '<=', 19)->get();
        return view('add_thl', compact(['unit_kerja']));
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $unit_kerja = UnitKerja::all();
        return view('edit_thl', compact(['user', 'unit_kerja']));
    }

    public function storeUser(Request $request)
    {

        $request->validate([
            'nik' => 'required|unique:users',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'unit_kerja_id' => 'required',
            'password' => 'required',
            'password2' => 'required|same:password'
        ]);


        $tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));

        $user = new User();
        $user->nik = $request->nik;
        $user->nama = $request->nama;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $tanggal_lahir;
        $user->alamat = $request->alamat;
        $user->pendidikan = $request->pendidikan;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->agama = $request->agama;
        $user->unit_kerja_id = $request->unit_kerja_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/')->with('success', 'Data berhasil ditambahkan');
    }

    public function updateUser(Request $request, $id)
    {

        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'unit_kerja_id' => 'required',
        ]);

        $tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));

        $user = User::find($id);
        $user->nik = $request->nik;
        $user->nama = $request->nama;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $tanggal_lahir;
        $user->alamat = $request->alamat;
        $user->pendidikan = $request->pendidikan;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->agama = $request->agama;
        $user->unit_kerja_id = $request->unit_kerja_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/')->with('success', 'Data berhasil diubah');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/')->with('success', 'Data berhasil dihapus');
    }

    public function admin()
    {

        $admins = User::where('unit_kerja_id', 21)->get();

        return view('data_admin', compact(['admins',]));
    }

    public function addAdmin()
    {
        $unit_kerja = UnitKerja::where('id', 21)->get();

        return view('add_admin', compact(['unit_kerja']));
    }

    public function storeAdmin(Request $request)
    {

        $request->validate([
            'nik' => 'required|unique:users',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'unit_kerja_id' => 'required',
            'password' => 'required',
            'password2' => 'required|same:password'
        ]);


        $tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));

        $user = new User();
        $user->nik = $request->nik;
        $user->nama = $request->nama;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $tanggal_lahir;
        $user->alamat = $request->alamat;
        $user->pendidikan = $request->pendidikan;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->agama = $request->agama;
        $user->unit_kerja_id = $request->unit_kerja_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/admin')->with('success', 'Data berhasil ditambahkan');
    }

    public function editAdmin($id)
    {
        $user = User::find($id);
        $unit_kerja = UnitKerja::where('id', 21)->get();
        return view('edit_admin', compact(['user', 'unit_kerja']));
    }

    public function updateAdmin(Request $request, $id)
    {

        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'unit_kerja_id' => 'required',
        ]);

        $tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));

        $user = User::find($id);
        $user->nik = $request->nik;
        $user->nama = $request->nama;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $tanggal_lahir;
        $user->alamat = $request->alamat;
        $user->pendidikan = $request->pendidikan;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->agama = $request->agama;
        $user->unit_kerja_id = $request->unit_kerja_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/admin')->with('success', 'Data berhasil diubah');
    }

    public function deleteAdmin($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/admin')->with('success', 'Data berhasil dihapus');
    }
}
