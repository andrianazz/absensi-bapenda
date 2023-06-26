@php
setlocale(LC_ALL, 'INA');

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data THL $unit_kerja->nama_unit_kerja.xls");
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .hasil {
            background-color: #DFE885;
        }
    </style>
    <title>Data THL</title>
</head>

<body>
    <div class="container-fluid" style="margin-left: 40dp; margin-right: 40dp;">
        <table class="mt-5 ">
            <tr>
                <th width='2.90%%'></th>
                <th width='9.78%'></th>
                <th width='19.20%'></th>
                <th width='15.58%'></th>
                <th width='6.88%'></th>
                <th width='11.23%'></th>
                <th width='5.43%'></th>
                <th width='16.30%'></th>
                <th width='12.68%'></th>
            </tr>
            <tr class="text-center">
                <td colspan="9" class="h4 font-weight-bolder"> DAFTAR TENAGA HARIAN LEPAS (THL) KANTOR BADAN PENDAPATAN DAERAH KOTA PEKANBARU</td>
            </tr>
            <tr height='24px'>
                <td colspan="9"></td>
            </tr>
            <tr></tr>
            <tr class="text-center" style="background-color: #8EA9DB; border: 1px solid black;">
                <td class="fw-bold" style="border: 1px solid black;"> No </td>
                <td class="fw-bold" style="border: 1px solid black;"> NIK </td>
                <td class="fw-bold" style="border: 1px solid black;"> Nama </td>
                <td class="fw-bold" style="border: 1px solid black;"> Tempat Tanggal Lahir </td>
                <td class="fw-bold" style="border: 1px solid black;"> Jenis Kelamin </td>
                <td class="fw-bold" style="border: 1px solid black;"> Pendidikan Terakhir </td>
                <td class="fw-bold" style="border: 1px solid black;"> Agama </td>
                <td class="fw-bold" style="border: 1px solid black;"> Alamat Tempat Tinggal Sekaranag </td>
                <td class="fw-bold" style="border: 1px solid black;"> Unit Kerja </td>
            </tr>
            @php
            $no = 1;
            @endphp
            @foreach ($users as $user)
            <tr class="table-bordered" style="border: 1px solid black;">
                <td class="" style="border: 1px solid black;"> {{ $no++ }} </td>
                <td class="" style="border: 1px solid black;"> {{ $user->nik }} </td>
                <td class="" style="border: 1px solid black;"> {{ $user->nama }} </td>
                <td class="" style="border: 1px solid black;"> {{ $user->tempat_lahir, date('d-m-Y', strtotime($user->tanggal_lahir) ) }} </td>
                <td class="text-center" style="border: 1px solid black;"> {{ $user->jenis_kelamin }} </td>
                <td class="text-center" style="border: 1px solid black;"> {{ $user->pendidikan }} </td>
                <td class="text-center" style="border: 1px solid black;"> {{ $user->agama }} </td>
                <td class="" style="border: 1px solid black;"> {{ $user->alamat }} </td>
                <td class="text-center" style="border: 1px solid black;"> {{ $user->unitKerja->nama_unit_kerja }} </td>
            </tr>
            @endforeach

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>

</html>