<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Masuk;
use Illuminate\Http\Request;

class MasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $masuk = Masuk::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data masuk masuk',
            'data' => $masuk
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'absensi_id' => 'required',
            'jam_masuk' => 'required',
            'long' => 'required',
            'lang' => 'required',
            'radius' => 'required',
            'status' => 'required'
        ]);

        $masuk = Masuk::create([
            'absensi_id' => $request->absensi_id,
            'jam_masuk' => $request->jam_masuk,
            'long' => $request->long,
            'lang' => $request->lang,
            'radius' => $request->radius,
            'status' => $request->status
        ]);

        if ($masuk) {
            return response()->json([
                'success' => true,
                'message' => 'Data masuk masuk berhasil disimpan',
                'data' => $masuk
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data masuk masuk gagal disimpan',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $masuk = Masuk::find($id);

        if ($masuk) {
            return response()->json([
                'success' => true,
                'message' => 'Detail data masuk masuk',
                'data' => $masuk
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data masuk masuk tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $masuk = Masuk::find($id);

        if ($masuk) {
            $masuk->update([
                'absensi_id' => $request->absensi_id,
                'jam_masuk' => $request->jam_masuk,
                'long' => $request->long,
                'lang' => $request->lang,
                'radius' => $request->radius,
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data masuk masuk berhasil diubah',
                'data' => $masuk
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data masuk masuk tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $masuk = Masuk::find($id);

        if ($masuk) {
            $masuk->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data masuk masuk berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data masuk masuk tidak ditemukan',
            ], 404);
        }
    }
}
