<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unit_kerja = UnitKerja::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data unit kerja',
            'data' => $unit_kerja
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_unit_kerja' => 'required',
        ]);

        $unit_kerja = UnitKerja::create([
            'nama_unit_kerja' => $request->nama_unit_kerja,
        ]);

        if ($unit_kerja) {
            return response()->json([
                'success' => true,
                'message' => 'Data unit kerja berhasil disimpan',
                'data' => $unit_kerja
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data unit kerja gagal disimpan',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unit_kerja = UnitKerja::find($id);

        if ($unit_kerja) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Data unit kerja',
                'data' => $unit_kerja
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data unit kerja tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $unit_kerja = UnitKerja::find($id);

        if ($unit_kerja) {
            $unit_kerja->update([
                'nama_unit_kerja' => $request->nama_unit_kerja,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data unit kerja berhasil diubah',
                'data' => $unit_kerja
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data unit kerja gagal diubah',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $unit_kerja = UnitKerja::find($id);

        if ($unit_kerja) {
            $unit_kerja->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data unit kerja berhasil dihapus',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data unit kerja gagal dihapus',
            ], 400);
        }
    }
}
