<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $absensi = Absensi::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data absensi',
            'data' => $absensi
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required',
        ]);

        $absensi = Absensi::create(
            [
                'user_id' => $request->user_id,
                'tanggal' => $request->tanggal
            ]
        );

        if ($absensi) {
            return response()->json([
                'success' => true,
                'message' => 'Data Absensi berhasil disimpan',
                'data' => $absensi
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Absensi gagal disimpan',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $absensi = Absensi::find($id);

        if ($absensi) {
            return response()->json([
                'success' => true,
                'message' => 'Detail data absens',
                'data' => $absensi
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data absens tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $absensi = Absensi::find($id);

        if ($absensi) {
            $absensi->update([
                'user_id' => $request->user_id,
                'tanggal' => $request->tanggal,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data absensi berhasil diubah',
                'data' => $absensi
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data absensi tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $absensi = Absensi::find($id);

        if ($absensi) {
            $absensi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data absensi berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data absensi tidak ditemukan',
            ], 404);
        }
    }
}
