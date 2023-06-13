<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pulang;
use Illuminate\Http\Request;

class PulangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pulang = Pulang::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data pulang',
            'data' => $pulang
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
            'jam_pulang' => 'required',
            'long' => 'required',
            'lang' => 'required',
            'radius' => 'required',
            'status' => 'required'
        ]);

        $pulang = Pulang::create([
            'absensi_id' => $request->absensi_id,
            'jam_pulang' => $request->jam_pulang,
            'long' => $request->long,
            'lang' => $request->lang,
            'radius' => $request->radius,
            'status' => $request->status
        ]);

        if ($pulang) {
            return response()->json([
                'success' => true,
                'message' => 'Data pulang berhasil disimpan',
                'data' => $pulang
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data pulang gagal disimpan',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pulang = Pulang::find($id);

        if ($pulang) {
            return response()->json([
                'success' => true,
                'message' => 'Detail data pulang',
                'data' => $pulang
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data pulang tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $pulang = Pulang::find($id);

        if ($pulang) {
            $update = $pulang->update([
                'absensi_id' => $request->absensi_id,
                'jam_pulang' => $request->jam_pulang,
                'long' => $request->long,
                'lang' => $request->lang,
                'radius' => $request->radius,
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data pulang berhasil diupdate',
                'data' => $pulang
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data pulang tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pulang = Pulang::find($id);

        if ($pulang) {
            $pulang->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data pulang berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data pulang tidak ditemukan',
            ], 404);
        }
    }
}
