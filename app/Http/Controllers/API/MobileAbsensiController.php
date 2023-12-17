<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Masuk;
use App\Models\Pulang;
use App\Models\Siang1;
use App\Models\Siang2;
use App\Models\Absensi;
use App\Models\Jam_absen;
use Illuminate\Http\Request;
use App\Models\Unitlokasikerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Lokasikerja;
use Illuminate\Support\Facades\Validator;

class MobileAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    function doAbsen()
    {

        if (!request()->header('Authorization')) {
            $row['status'] = 'error';
            $row['is_validate'] = false;
            $row['message'] = 'Header Authorization diperlukan';


            return response()->json($row, 401);
            die;
        }

        $authorizationHeader = request()->header('Authorization');

        // Memisahkan username dan password dari header Authorization
        $credentials = base64_decode(substr($authorizationHeader, 6)); // Menghilangkan "Basic " dan mendekode Base64
        list($username, $password) = explode(':', $credentials);

        // Mengecek apakah username dan password sesuai dengan yang diharapkan
        if ($username != 'Absenbapenda' || $password != "b2@Y@3SaN!") {

            $row['status'] = 'error';
            $row['is_validate'] = false;
            $row['message'] = 'Autentikasi gagal';

            return response()->json($row);
            die;
        }

        $Md_user = new User;
        $Md_jamabsen = new Jam_absen;
        $Md_unitlokasikerja = new Unitlokasikerja;
        $Md_absensi = new Absensi;
        $Md_lokasikerja = new Lokasikerja;
        $rules = array(
            'user_id' => 'required',
            'lan' => 'required',
            'lat' => 'required',
        );
        $validator = Validator::make(request()->all(), $rules);

        // Validate the input and return correct response
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'is_validate' => false,
                'message' => 'Harap isi seluruh data'
            ]); // Tambahkan kode status HTTP 400

        }

        //cek hari libur
        // Mendapatkan nilai hari saat ini (1 = Senin, 2 = Selasa, ..., 7 = Minggu)
        if (date('N') == 6 || date('N') == 7) {
            return response()->json([
                'status' => 'error',
                'is_validate' => true,
                'message' => 'Hari ini libur!'
            ]); // Tambahkan kode status HTTP 400

        }

        $user_id = request()->user_id;

        $lan = round(request()->lan, 14);
        $lat = round(request()->lat, 14);
        $jam = date('H:i:s');
        $datenow = date('Y-m-d');
        $datetimenow = date('Y-m-d H:i:s');

        //$jam = '11:45:00';
        //get User
        $getUser = $Md_user->getUserById($user_id);

        if (!$getUser) {
            return response()->json([
                'status' => 'error',
                'is_validate' => true,
                'message' => 'Data User Tidak Ditemukan'
            ]); // Tambahkan kode status HTTP 400
        }



        //cek jam absen
        $getJamAbsen = $Md_jamabsen->getJamAbsenByJam($jam);


        if (!$getJamAbsen) {
            return response()->json([
                'status' => 'error',
                'is_validate' => true,
                'message' => 'Saat ini bukan jam absen'
            ]); // Tambahkan kode status HTTP 400
        }

        $lokasiKantor = $Md_unitlokasikerja->getLokasiUnitKantorByUnitKerja($getUser->unit_kerja_id);

        if ($lokasiKantor->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'is_validate' => true,
                'message' => 'Anda Tidak Terdaftar di kantor manapun'
            ]); // Tambahkan kode status HTTP 400

        }

        $is_absensama = false;
        //cek apakah sudah absen atau belum 
        if ($getJamAbsen->jenis_absen == 'Pulang') {
            $dtAbsen =  $Md_absensi->getAbsenPulangByUserid($user_id);
        } else if ($getJamAbsen->jenis_absen == 'Masuk') {
            $dtAbsen =  $Md_absensi->getAbsenMasukByUserid($user_id);
            $is_absensama = true;
        } else if ($getJamAbsen->jenis_absen == 'Siang1') {
            $dtAbsen =  $Md_absensi->getAbsenSiangSatuByUserid($user_id);
        } else {
            $dtAbsen =  $Md_absensi->getAbsenSiangDuaByUserid($user_id);
        }


        if ($dtAbsen) {
            return response()->json([
                'status' => 'error',
                'is_validate' => true,
                'message' => 'Anda Sudah Absen di Waktu ' . $getJamAbsen->jenis_absen
            ]);
        }




        $is_adalokasi = false;
        $radius_u = 0;
        $data_lokasi = '';
        if ($is_absensama) {
            $getlokasiAbsen = $Md_lokasikerja->getLokasiKerjaById(1);
            $getJarak =  getDistance($lat, $lan, $getlokasiAbsen->maxradius, $getlokasiAbsen->lat, $getlokasiAbsen->lan);


            if ($getJarak['status']) {
                $is_adalokasi = true;
                $radius_u = round($getJarak['jarak']);
                $data_lokasi = $getlokasiAbsen;
            }
        } else {
            foreach ($lokasiKantor as $lk) {
                $getJarak =  getDistance($lat, $lan, $lk->maxradius, $lk->lat, $lk->lan);

                if ($getJarak['status']) {
                    $is_adalokasi = true;
                    $radius_u = round($getJarak['jarak']);
                    $data_lokasi = $lk;
                }
            }
        }



        if ($is_adalokasi == false) {
            return response()->json([
                'status' => 'error',
                'is_validate' => true,
                'message' => 'Ada Sedang Tidak pada posisi Kantor'
            ]); // Tambahkan kode status HTTP 400

        }

        $dtAbsensi = $Md_absensi->getAbsenByUserid($user_id);


        DB::beginTransaction();
        try {
            if (!$dtAbsensi) {
                $dataInsert = [
                    'user_id' => $user_id,
                    'created_at' => $datetimenow,
                    'updated_at' => $datetimenow,
                    'tanggal' => $datenow,
                ];
                $absensiId =  Absensi::create($dataInsert)->id;
            } else {
                $absensiId = $dtAbsensi->id;
            }

            $dataAbsenInsert = array(
                'absensi_id' => $absensiId,
                'long' =>  $lan,
                'lang' =>  $lat,
                'radius' => $radius_u,
                'status' => $data_lokasi->jns_lokasi,
                'created_at' => $datetimenow,
                'updated_at' => $datetimenow,

            );
            if ($getJamAbsen->jenis_absen == 'Pulang') {
                $dtWaktu = array('jam_pulang' => $jam);
                $gabungDataAbsen = array_merge($dataAbsenInsert, $dtWaktu);
                Pulang::create($gabungDataAbsen);
            } else if ($getJamAbsen->jenis_absen == 'Masuk') {
                $dtWaktu = array('jam_masuk' => $jam);
                $gabungDataAbsen = array_merge($dataAbsenInsert, $dtWaktu);
                Masuk::create($gabungDataAbsen);
            } else if ($getJamAbsen->jenis_absen == 'Siang1') {
                $dtWaktu = array('jam_siang' => $jam);
                $gabungDataAbsen = array_merge($dataAbsenInsert, $dtWaktu);
                Siang1::create($gabungDataAbsen);
            } else {
                $dtWaktu = array('jam_siang2' => $jam);
                $gabungDataAbsen = array_merge($dataAbsenInsert, $dtWaktu);
                Siang2::create($gabungDataAbsen);
            }

            // Gabungkan array

            DB::commit();
            return response()->json(
                [
                    'status' => 'success',
                    'is_validate' => true,
                    'message' => 'Data Berhasil Disimpan'
                ]
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::info($e);

            return response()->json([
                'status' => 'error',
                'is_validate' => true,
                'message' => 'Terdapat Kegagalan'
            ]); // Tambahkan kode status HTTP 400
        }
    }

    function getAbsen($param1)
    {

        if (!request()->header('Authorization')) {
            $row['status'] = 'error';
            $row['is_validate'] = false;
            $row['message'] = 'Header Authorization diperlukan';


            return response()->json($row, 401);
            die;
        }

        $authorizationHeader = request()->header('Authorization');

        // Memisahkan username dan password dari header Authorization
        $credentials = base64_decode(substr($authorizationHeader, 6)); // Menghilangkan "Basic " dan mendekode Base64
        list($username, $password) = explode(':', $credentials);

        // Mengecek apakah username dan password sesuai dengan yang diharapkan
        if ($username != 'Absenbapenda' || $password != "b2@Y@3SaN!") {

            $row['status'] = 'error';
            $row['is_validate'] = false;
            $row['message'] = 'Autentikasi gagal';

            return response()->json($row);
            die;
        }

        $Md_absensi = new Absensi();
        $user_id = $param1;
        $datenow = date('Y-m-d');
        $arrDate = array();

        $dataToday = array();

        //getAbsenHariIni
        $getabsen = $Md_absensi->getAbsenByTglAndUserid($datenow, $user_id);
        if ($getabsen) {
            $dataToday = [
                'jam_masuk' => $getabsen->jam_masuk,
                'jam_siang' => $getabsen->jam_siang,
                'jam_siang2' => $getabsen->jam_siang2,
                'jam_pulang' => $getabsen->jam_pulang
            ];
        } else {
            $dataToday = [
                'jam_masuk' => '-',
                'jam_siang' => '-',
                'jam_siang2' => '-',
                'jam_pulang' => '-',
            ];
        }

        //getAbsen2Hari 
        for ($i = 1; $i <= 2; $i++) {
            $dateloop = date('Y-m-d', strtotime($datenow . ' -' . $i . ' day'));
            //array_push($arrDate, date('Y-m-d', strtotime($datenow . ' -' . $i . ' day')));

            $getabsen = $Md_absensi->getAbsenByTglAndUserid($dateloop, $user_id);
            if ($getabsen) {
                array_push($arrDate, array(
                    'tanggal' => $dateloop,
                    'jam_masuk' => $getabsen->jam_masuk,
                    'jam_siang' => $getabsen->jam_siang,
                    'jam_siang2' => $getabsen->jam_siang2,
                    'jam_pulang' => $getabsen->jam_pulang,
                ));
            } else {
                array_push($arrDate, array(
                    'tanggal' => $dateloop,
                    'jam_masuk' => '-',
                    'jam_siang' => '-',
                    'jam_siang2' => '-',
                    'jam_pulang' => '-',
                ));
            }
        }

        $row['status'] = 'success';
        $row['absentoday'] = $dataToday;
        $row['absenbefore'] = $arrDate;
        $row['message'] = 'Data Berhasil Diambil';

        return response()->json($row);
        die;
    }
}
