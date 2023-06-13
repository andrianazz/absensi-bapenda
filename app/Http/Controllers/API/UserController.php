<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar data user',
            'data' => $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users|',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'pendidikan' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'unit_kerja_id' => 'required',
            'imageUrl' => 'nullable',
            'password' => 'required',
        ]);

        $user = User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan' => $request->pendidikan,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'unit_kerja_id' => $request->unit_kerja_id,
            'imageUrl' => $request->imageUrl,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User gagal ditambahkan',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Detail data user',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data user tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::find($id);

        if ($user) {
            $user->update([
                'nik' => $request->nik ? $request->nik : $user->nik,
                'nama' => $request->nama ? $request->nama : $user->nama,
                'tempat_lahir' => $request->tempat_lahir ? $request->tempat_lahir : $user->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir ? $request->tanggal_lahir : $user->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin ? $request->jenis_kelamin : $user->jenis_kelamin,
                'pendidikan' => $request->pendidikan ? $request->pendidikan : $user->pendidikan,
                'agama' => $request->agama ? $request->agama : $user->agama,
                'alamat' => $request->alamat ? $request->alamat : $user->alamat,
                'unit_kerja_id' => $request->unit_kerja_id ? $request->unit_kerja_id : $user->unit_kerja_id,
                'imageUrl' => $request->imageUrl ? $request->imageUrl : $user->imageUrl,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diupdate',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User gagal diupdate',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User gagal dihapus',
            ], 404);
        }
    }
}
