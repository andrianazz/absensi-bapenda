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

class RekapController extends Controller
{
    public function index()
    {
        $unit_kerja = UnitKerja::where('id', '<=', 19)->get();

        $currentDate = date('Y-m-d'); // Get current date
        $monday = date('Y-m-d', strtotime('this week', strtotime($currentDate)));

        $this_week = [];
        for ($i = 0; $i < 5; $i++) {
            $this_week[] = date('Y-m-d', strtotime($monday . ' + ' . $i . ' days'));
        }

        $users = User::where('unit_kerja_id', '<=', 19)->get();
        $absensiUser = [];

        $masuks = Masuk::all();
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
        }



        return view('rekap_absen', compact(['unit_kerja', 'absensiUser', 'this_week', 'users']));
    }

    public function showIndex($id)
    {
        $unit_kerja = UnitKerja::where('id', '<=', 19)->get();

        $currentDate = date('Y-m-d'); // Get current date
        $monday = date('Y-m-d', strtotime('this week', strtotime($currentDate)));

        $this_week = [];
        for ($i = 0; $i < 5; $i++) {
            $this_week[] = date('Y-m-d', strtotime($monday . ' + ' . $i . ' days'));
        }

        $users = User::where('unit_kerja_id', $id)->get();
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
        }




        return view('rekap_absen', compact(['unit_kerja', 'absensiUser', 'this_week', 'users']));
    }
}
