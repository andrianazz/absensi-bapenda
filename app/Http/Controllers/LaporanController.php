<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Masuk;
use App\Models\Pulang;
use App\Models\Siang1;
use App\Models\Siang2;
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
            $unit_kerja = UnitKerja::where('id', $request->unit_kerja)->first();
            $users = User::where('unit_kerja_id', $request->unit_kerja)->get();

            return view('excell_thl', compact('users', 'unit_kerja'));
        } else if ($request->input('action') === 'PDF') {
            $unit_kerja = UnitKerja::where('id', $request->unit_kerja)->first();
            $users = User::where('unit_kerja_id', $request->unit_kerja)->get();

            // return view('pdf_thl', compact('users', 'unit_kerja'));

            $pdf = Pdf::loadView('pdf_thl', compact('users', 'unit_kerja'));
            $pdf = $pdf->setPaper('a4', 'landscape');
            return $pdf->stream('laporan_thl_' . $unit_kerja->nama_unit_kerja . '.pdf');
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
            $unit_kerja = UnitKerja::where('id', $request->unit_kerja)->first();
            $users = User::where('unit_kerja_id', $request->unit_kerja)->get();

            $currentDate = date('Y-m-d'); // Get current date
            $monday = date('Y-m-d', strtotime('this week', strtotime($currentDate)));
            $this_week = [];
            for ($i = 0; $i < 5; $i++) {
                $this_week[] = date('Y-m-d', strtotime($monday . ' + ' . $i . ' days'));
            }


            $absensiUser = [];

            // $masuks = Masuk::all();
            foreach ($users as $index => $user) {

                for ($i = 0; $i < 5; $i++) {
                    $absensi = Absensi::where('user_id', $user->id)->where('tanggal', $this_week[$i])->get()->first();
                    if ($absensi != null) {
                        $masuk = Masuk::where('absensi_id', $absensi->id)->get()->first();
                        $siang1 = Siang1::where('absensi_id', $absensi->id)->get()->first();
                        $siang2 = Siang2::where('absensi_id', $absensi->id)->get()->first();
                        $pulang = Pulang::where('absensi_id', $absensi->id)->get()->first();

                        $absensiUser[$index]['masuk'][$i] = $masuk;
                        $absensiUser[$index]['siang1'][$i] = $siang1;
                        $absensiUser[$index]['siang2'][$i] = $siang2;
                        $absensiUser[$index]['pulang'][$i] = $pulang;
                    } else {
                        $absensiUser[$index]['masuk'][$i] = null;
                        $absensiUser[$index]['siang1'][$i] = null;
                        $absensiUser[$index]['siang2'][$i] = null;
                        $absensiUser[$index]['pulang'][$i] = null;
                    }
                }

                // cek apakah absensi user setiap indexnya null?
                $cek = 0;
                for ($i = 0; $i < 5; $i++) {
                    if ($absensiUser[$index]['masuk'][$i] != null) {
                        $cek++;
                    }

                    if ($absensiUser[$index]['siang1'][$i] != null) {
                        $cek++;
                    }

                    if ($absensiUser[$index]['siang2'][$i] != null) {
                        $cek++;
                    }

                    if ($absensiUser[$index]['pulang'][$i] != null) {
                        $cek++;
                    }

                    $absensiUser[$index]['ket'] = $cek;
                }
            }
            return view('excell_absen', compact('users', 'unit_kerja', 'this_week', 'absensiUser'));
        } else if ($request->input('action') === 'PDF') {
            $unit_kerja = UnitKerja::where('id', $request->unit_kerja)->first();
            $users = User::where('unit_kerja_id', $request->unit_kerja)->get();

            $currentDate = date('Y-m-d'); // Get current date
            $monday = date('Y-m-d', strtotime('this week', strtotime($currentDate)));
            $this_week = [];
            for ($i = 0; $i < 5; $i++) {
                $this_week[] = date('Y-m-d', strtotime($monday . ' + ' . $i . ' days'));
            }


            $absensiUser = [];

            // $masuks = Masuk::all();
            foreach ($users as $index => $user) {

                for ($i = 0; $i < 5; $i++) {
                    $absensi = Absensi::where('user_id', $user->id)->where('tanggal', $this_week[$i])->get()->first();
                    if ($absensi != null) {
                        $masuk = Masuk::where('absensi_id', $absensi->id)->get()->first();
                        $siang1 = Siang1::where('absensi_id', $absensi->id)->get()->first();
                        $siang2 = Siang2::where('absensi_id', $absensi->id)->get()->first();
                        $pulang = Pulang::where('absensi_id', $absensi->id)->get()->first();

                        $absensiUser[$index]['masuk'][$i] = $masuk;
                        $absensiUser[$index]['siang1'][$i] = $siang1;
                        $absensiUser[$index]['siang2'][$i] = $siang2;
                        $absensiUser[$index]['pulang'][$i] = $pulang;
                    } else {
                        $absensiUser[$index]['masuk'][$i] = null;
                        $absensiUser[$index]['siang1'][$i] = null;
                        $absensiUser[$index]['siang2'][$i] = null;
                        $absensiUser[$index]['pulang'][$i] = null;
                    }
                }

                // cek apakah absensi user setiap indexnya null?
                $cek = 0;
                for ($i = 0; $i < 5; $i++) {
                    if ($absensiUser[$index]['masuk'][$i] != null) {
                        $cek++;
                    }

                    if ($absensiUser[$index]['siang1'][$i] != null) {
                        $cek++;
                    }

                    if ($absensiUser[$index]['siang2'][$i] != null) {
                        $cek++;
                    }

                    if ($absensiUser[$index]['pulang'][$i] != null) {
                        $cek++;
                    }

                    $absensiUser[$index]['ket'] = $cek;
                }
            }
            // return view('pdf_absen', compact('users', 'unit_kerja', 'this_week', 'absensiUser'));

            $pdf = Pdf::loadView('pdf_absen', compact('users', 'unit_kerja', 'this_week', 'absensiUser'));
            $pdf = $pdf->setPaper('a4', 'landscape');
            return $pdf->stream('rekap_absen' . $unit_kerja->nama_unit_kerja . '.pdf');
        } else if ($request->input('action') === 'cari') {

            return redirect('/rekap-absen/' . $request->unit_kerja);
        }
    }
}
