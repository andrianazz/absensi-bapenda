<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Siang1;
use Illuminate\Http\Request;

class Siang1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siang1 = Siang1::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data siang1',
            'data' => $siang1
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
            'jam_siang' => 'required',
            'long' => 'required',
            'lang' => 'required',
            'radius' => 'required',
            'status' => 'required'
        ]);

        $siang1 = Siang1::create([
            'absensi_id' => $request->absensi_id,
            'jam_siang' => $request->jam_siang,
            'long' => $request->long,
            'lang' => $request->lang,
            'radius' => $request->radius,
            'status' => $request->status
        ]);

        if ($siang1) {
            return response()->json([
                'success' => true,
                'message' => 'Data siang1 berhasil disimpan',
                'data' => $siang1
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data siang1 gagal disimpan',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $siang1 = Siang1::find($id);

        if ($siang1) {
            return response()->json([
                'success' => true,
                'message' => 'Detail data siang1',
                'data' => $siang1
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data siang1 tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $siang1 = Siang1::find($id);

        if ($siang1) {
            $update = $siang1->update([
                'absensi_id' => $request->absensi_id,
                'jam_siang' => $request->jam_siang,
                'long' => $request->long,
                'lang' => $request->lang,
                'radius' => $request->radius,
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data siang1 berhasil diupdate',
                'data' => $siang1
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data siang1 gagal diupdate',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $siang1 = Siang1::find($id);

        if ($siang1) {
            $siang1->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data siang1 berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data siang1 gagal dihapus',
            ], 400);
        }
    }
}
