
<?php


if (!function_exists("currency_format")) {
    function currency_format($angka)
    {
        $hasil_rupiah = number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
}


if (!function_exists("calculateDistance")) {
    function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius of the Earth in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c * 1000; // Convert distance to meters

        return $distance;
    }
}

if (!function_exists("getDistance")) {
    function getDistance($lat_u, $lon_u, $maxradius, $lat_k, $lon_k)
    {

        // Lokasi kantor
        $kantorLat = $lat_k;
        $kantorLong = $lon_k;

        // Lokasi Anda
        $lokasiSayaLat = $lat_u;
        $lokasiSayaLong = $lon_u;

        // Radius dalam meter
        $maxradiusMeter = $maxradius;

        // Hitung jarak antara kedua lokasi
        $jarak = calculateDistance($kantorLat, $kantorLong, $lokasiSayaLat, $lokasiSayaLong);

        // Tampilkan informasi jarak dan radius dalam pesan keluaran
        //echo "Jarak dari lokasi Anda ke kantor: $jarak meter.";

        // Periksa apakah lokasi Anda berada dalam radius
        if ($jarak <= $maxradiusMeter) {

            return [
                'status' => true,
                'jarak' => $jarak
            ];
            // echo " Anda berada dalam radius kantor.";
        } else {
            return
                [
                    'status' => false,
                ];
            //echo " Anda berada di luar radius kantor.";
        }
    }
}
