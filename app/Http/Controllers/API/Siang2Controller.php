<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Siang2;
use Illuminate\Http\Request;

class Siang2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siang2 = Siang2::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data siang2',
            'data' => $siang2
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
            'jam_siang2' => 'required',
            'long' => 'required',
            'lang' => 'required',
            'radius' => 'required',
            'status' => 'required'
        ]);

        $siang2 = Siang2::create([
            'absensi_id' => $request->absensi_id,
            'jam_siang2' => $request->jam_siang2,
            'long' => $request->long,
            'lang' => $request->lang,
            'radius' => $request->radius,
            'status' => $request->status
        ]);

        if ($siang2) {
            return response()->json([
                'success' => true,
                'message' => 'Data siang2 berhasil disimpan',
                'data' => $siang2
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data siang2 gagal disimpan',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $siang2 = Siang2::find($id);

        if ($siang2) {
            return response()->json([
                'success' => true,
                'message' => 'Detail data siang2',
                'data' => $siang2
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data siang2 tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $siang2 = Siang2::find($id);

        if ($siang2) {
            $update = $siang2->update([
                'absensi_id' => $request->absensi_id,
                'jam_siang2' => $request->jam_siang2,
                'long' => $request->long,
                'lang' => $request->lang,
                'radius' => $request->radius,
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data siang2 berhasil diupdate',
                'data' => $siang2
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data siang2 tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $siang2 = Siang2::find($id);

        if ($siang2) {
            $siang2->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data siang2 berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data siang2 tidak ditemukan',
            ], 404);
        }
    }
}
