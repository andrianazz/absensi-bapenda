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
            <div class="card-header">Data Full Seluruh THL</div>
            <div class="row text-center mx-4">
                <form action="/cetak-thl" method="post">
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
                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                <button type="submit" name="action" value="Excel" class="btn btn-danger">Cetak Excel</button>
                                <button type="submit"  name="action" value="PDF" class="btn btn-success">Cetak PDF</button>
                            </div>
                        </div>

                        <div class="col-md-3">
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
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>NIK</th>
                            <th width="250px">Nama</th>
                            <th>TTL</th>
                            <th>Jenis Kelamin</th>
                            <th >Pend. Terakhir</th>
                            <th width="50px">Agama</th>
                            <th width="250px">Alamat</th>
                            <th width="250px">Unit Kerja</th>
                            <th class="text-center" width="250px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp

                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $user->nik }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->tempat_lahir, $user->tanggal_lahir }}</td>
                            <td>{{ $user->jenis_kelamin }}</td>
                            <td>{{ $user->pendidikan }}</td>
                            <td>{{ $user->agama }}</td>
                            <td>{{ $user->alamat }}</td>
                            <td>{{ $user->unitKerja->nama_unit_kerja  }}</td>
                            <td class="text-center">
                                <a href="/edit-user/{{$user->id}}" class="btn icon icon-left btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg> Edit
                                </a>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#danger{{$user->id}}" class="btn icon icon-left btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg> Hapus
                                </button>

                                <div class="modal fade text-left" id="danger{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title white" id="myModalLabel120">Hapus Data User
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah kamu yakin ingin menghapus data admin {{ $user->nama }} ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Batal</span>
                                                </button>
                                                <form action="/user/{{$user->id}}/delete" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger ms-1" data-bs-dismiss="modal">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection