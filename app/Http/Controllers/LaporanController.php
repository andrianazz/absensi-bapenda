<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{
    public function cetakThl(Request $request)
    {
        if ($request->unit_kerja == null) {
            return redirect('/');
        }



        if ($request->input('action') === 'Excel') {
        } else if ($request->input('action') === 'PDF') {
            $unit_kerja = UnitKerja::where('id', $request->unit_kerja)->first();
            $users = User::where('unit_kerja_id', $request->unit_kerja)->get();

            return view('pdf_thl', compact('users', 'unit_kerja'));

            // $pdf = Pdf::loadView('pdf_thl', compact('users', 'unit_kerja'));
            // $pdf = $pdf->setPaper('a4', 'landscape');
            // return $pdf->stream('laporan_thl_' . $unit_kerja->nama_unit_kerja . '.pdf');
        } else if ($request->input('action') === 'cari') {

            return redirect('/rekap-absen/' . $request->unit_kerja);
        }
    }

    public function cetakRekap(Request $request)
    {
        if ($request->unit_kerja == null) {
            return redirect('/rekap-absen');
        }



        if ($request->input('action') === 'Excel') {
        } else if ($request->input('action') === 'PDF') {
            $unit_kerja = UnitKerja::where('id', $request->unit_kerja)->first();
            $users = User::where('unit_kerja_id', $request->unit_kerja)->get();

            //Ganti view
            return view('pdf_thl', compact('users', 'unit_kerja'));

            // $pdf = Pdf::loadView('pdf_thl', compact('users', 'unit_kerja'));
            // $pdf = $pdf->setPaper('a4', 'landscape');
            // return $pdf->stream('laporan_thl_' . $unit_kerja->nama_unit_kerja . '.pdf');
        } else if ($request->input('action') === 'cari') {

            return redirect('/rekap-absen/' . $request->unit_kerja);
        }
    }
}
