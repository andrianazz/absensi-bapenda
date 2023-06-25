@extends('layouts.main')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data THL</h3>
                <p class="text-subtitle text-muted">
                    Data Tenaga Harian Lepas (THL) Bapenda Kota Pekanbaru
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Admin</a>
                        </li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">Data Full Seluruh THL </div>
            <div class="row text-center mx-4">
                <form action="/cetak-rekap" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Pilih Unit</label>
                                <select name="unit_kerja" id="filter" class="form-select" id="inputGroupSelect01">
                                    <option value="">Pilih Unit Kerja</option>
                                    @foreach ($unit_kerja as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->nama_unit_kerja }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" name="action" value="cari" class="btn btn-info">Cari Unit</button>
                        </div>


                        <div class="col-md-3">
                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                <button type="submit" name="action" value="Excel" class="btn btn-danger">Cetak Excel</button>
                                <button type="submit" name="action" value="PDF" class="btn btn-success">Cetak PDF</button>
                            </div>
                        </div>
                        <div class="col-md-3 text-end">
                            <a href="{{ url('/add-user') }}" class="btn icon icon-left btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg> Tambah
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped" border="1" id="table1">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-center">No</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Status</th>
                            @foreach($this_week as $day)
                            <th colspan="4" class="text-center">{{ $day }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <td>P</td>
                            <td>S1</td>
                            <td>S2</td>
                            <td>SR</td>
                            <td>P</td>
                            <td>S1</td>
                            <td>S2</td>
                            <td>SR</td>
                            <td>P</td>
                            <td>S1</td>
                            <td>S2</td>
                            <td>SR</td>
                            <td>P</td>
                            <td>S1</td>
                            <td>S2</td>
                            <td>SR</td>
                            <td>P</td>
                            <td>S1</td>
                            <td>S2</td>
                            <td>SR</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($users as $index =>$user)

                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>THL</td>
                            @for($i = 0; $i < 5; $i++) <td>{{ $absensiUser[$index]['masuk'][$i] != null ? '✔️': '❌'}}</td>
                                <td>{{ $absensiUser[$index]['siang1'][$i] != null ? '✔️': '❌'}}</td>
                                <td>{{ $absensiUser[$index]['siang2'][$i] != null ? '✔️': '❌'}}</td>
                                <td>{{ $absensiUser[$index]['pulang'][$i] != null ? '✔️': '❌'}}</td>
                                @endfor
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection