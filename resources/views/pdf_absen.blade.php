@php
setlocale(LC_ALL, 'IND');
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
        <table width='100%' class="mt-5 ">
            <tr>
                <th width='2.80%'></th>
                <th width='28.04%'></th>
                <th width='6.54%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='2.80%'></th>
                <th width='6.54%'></th>
            </tr>

            <tr class="text-center">
                <td colspan="24" class="h4 fw-bold">REKAP ABSEN THL</td>
            </tr>
            <tr class="text-center">
                <td colspan="24" class="h4 fw-bold">BADAN PENDAPATAN DAERAH KOTA PEKANBARU</td>
            </tr>
            <tr class="text-center">
                <td colspan="24" class="h4 fw-bold">{{ date("F Y") }} </td>
            </tr>

            <tr height='20px'><br></tr>

            <tr>
                <td colspan="24" class="fw-bold">Bidang: {{ $unit_kerja->nama_unit_kerja }}  </td>
            </tr>

            <tr class="text-center" style="background-color: #8EA9DB; border: 1px solid black;">
                <td rowspan="2" class="fw-bold" style="border: 1px solid black;">No</td>
                <td rowspan="2" class="fw-bold" style="border: 1px solid black;">Nama</td>
                <td rowspan="2" class="fw-bold" style="border: 1px solid black;">Status</td>
                @foreach($this_week as $day)
                <td colspan="4" class="fw-bold" style="border: 1px solid black;">{{ $day }}</td>
                @endforeach
                <td rowspan="2" class="fw-bold" style="border: 1px solid black;">Ket</td>
            </tr>
            <tr class="text-center" style="background-color: #8EA9DB; border: 1px solid black;">
                <td class="fw-bold" style="border: 1px solid black;">P</td>
                <td class="fw-bold" style="border: 1px solid black;">S1</td>
                <td class="fw-bold" style="border: 1px solid black;">S2</td>
                <td class="fw-bold" style="border: 1px solid black;">SR</td>
                <td class="fw-bold" style="border: 1px solid black;">P</td>
                <td class="fw-bold" style="border: 1px solid black;">S1</td>
                <td class="fw-bold" style="border: 1px solid black;">S2</td>
                <td class="fw-bold" style="border: 1px solid black;">SR</td>
                <td class="fw-bold" style="border: 1px solid black;">P</td>
                <td class="fw-bold" style="border: 1px solid black;">S1</td>
                <td class="fw-bold" style="border: 1px solid black;">S2</td>
                <td class="fw-bold" style="border: 1px solid black;">SR</td>
                <td class="fw-bold" style="border: 1px solid black;">P</td>
                <td class="fw-bold" style="border: 1px solid black;">S1</td>
                <td class="fw-bold" style="border: 1px solid black;">S2</td>
                <td class="fw-bold" style="border: 1px solid black;">SR</td>
                <td class="fw-bold" style="border: 1px solid black;">P</td>
                <td class="fw-bold" style="border: 1px solid black;">S1</td>
                <td class="fw-bold" style="border: 1px solid black;">S2</td>
                <td class="fw-bold" style="border: 1px solid black;">SR</td>

            </tr>
            @php
            $no = 1;
            @endphp
            @foreach($users as $index =>$user)
            <tr class="text-center" style="border: 1px solid black;">
                <td style="border: 1px solid black;">{{ $no++ }}</td>
                <td class="text-start" style="border: 1px solid black;">{{ $user->nama }}</td>
                <td style="border: 1px solid black;">THL</td>
                @for($i = 0; $i < 5; $i++) 
                    @if ($this_week[$i] <= date('Y-m-d'))
                        <td style="border: 1px solid black;" class="fw-bold {{ $absensiUser[$index]['masuk'][$i] != null ? 'text-success' : 'text-danger'}}">{{ $absensiUser[$index]['masuk'][$i] != null ? 'O' : 'X'}}</td>
                        <td style="border: 1px solid black;" class="fw-bold {{ $absensiUser[$index]['siang1'][$i] != null ? 'text-success' : 'text-danger'}}">{{ $absensiUser[$index]['siang1'][$i] != null ? 'O' : 'X'}}</td>
                        <td style="border: 1px solid black;" class="fw-bold {{ $absensiUser[$index]['siang2'][$i] != null ? 'text-success' : 'text-danger'}}">{{ $absensiUser[$index]['siang2'][$i] != null ? 'O' : 'X'}}</td>
                        <td style="border: 1px solid black;" class="fw-bold {{ $absensiUser[$index]['pulang'][$i] != null ? 'text-success' : 'text-danger'}}">{{ $absensiUser[$index]['pulang'][$i] != null ? 'O' : 'X'}}</td>
                    @else
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                    @endif
                @endfor
                <td style="border: 1px solid black;">H: {{ $absensiUser[$index]['hadir'] }} <br> A: {{ $absensiUser[$index]['alpha']}}  </td>
            </tr>
            @endforeach

            <tr height="20px">
                <td colspan="24"><br></td>
            </tr>

            <tr>
                <td colspan="13"></td>
                <td colspan="11">Pekanbaru, {{ date('d F Y') }}</td>
            </tr>

            <tr height="20px"></tr>

            <tr>
                <td colspan="13"></td>
                <td colspan="11" class="fw-bold">An. KEPALA BADAN PENDAPATAN DAERAH</td>
            </tr>
            <tr>
                <td colspan="14"></td>
                <td colspan="10" class="fw-bold">KOTA PEKANBARU</td>
            </tr>
            <tr>
                <td colspan="14"></td>
                <td colspan="10" class="fw-bold">Sekretaris,</td>
            </tr>
            <tr>
                <td colspan="14"></td>
                <td colspan="10" class="fw-bold">Ub. Subbag Umum</td>
            </tr>

            <tr height="60px"><br><br></tr>

            <tr>
                <td colspan="14"></td>
                <td colspan="10" class="fw-bold">JOHANNES SUPREDO SINAGA RUMAPEA, S.STP</td>
            </tr>
            <tr>
                <td colspan="14"></td>
                <td colspan="10">Penata</td>
            </tr>
            <tr>
                <td colspan="14"></td>
                <td colspan="10">NIP. 19941226 201609 1 003</td>
            </tr>

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>
</body>

</html>