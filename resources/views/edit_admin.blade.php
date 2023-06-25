@extends('layouts.main')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Admin</h4>
    </div>

    <div class="card-body">
        <form action="/edit-admin/{{ $user->id }}/update" method="post">
            <div class="row">
                @csrf
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="basicInput">NIK </label>
                        <input name="nik" type="text" class="form-control" id="basicInput" placeholder="Masukkan NIK" value="{{ $user->nik }}">
                    </div>

                    <div class="form-group">
                        <label for="helpInputTop">Nama Lengkap</label>
                        <small class="text-muted">eg.<i>Andrian Wahyu</i></small>
                        <input name="nama" type="text" class="form-control" id="helpInputTop" placeholder="Masukkan Nama" value="{{ $user->nama }}"> 
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="basicInput">Tempat Lahir </label>
                            <input name="tempat_lahir" type="text" class="form-control" id="basicInput" placeholder="Masukkan Tempat Lahir" value="{{ $user->tempat_lahir }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Pendidikan </label>
                        <div class="input-group mb-3">
                            <select name="pendidikan" class="form-select" id="inputGroupSelect01">
                                <option selected="{{ $user->pendidikan }}">{{ $user->pendidikan }}</option>
                                <option value="S3">S3</option>
                                <option value="S2">S2</option>
                                <option value="S1">S1</option>
                                <option value="SMA/SMK">SMA/SMK</option>
                                <option value="SMP">SMP</option>
                                <option value="SD">SD</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="disabledInput">Tanggal Lahir</label>
                        <input name="tanggal_lahir" type="text" class="form-control mb-3 flatpickr-no-config flatpickr-input active" placeholder="Pilih Tanggal.." readonly="readonly" value="{{ $user->tanggal_lahir }}">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Alamat </label>
                        <input name="alamat" type="text" class="form-control" id="basicInput" placeholder="Masukkan Alamat" value="{{ $user->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Kelamin </label>
                        <div class="input-group mb-3">
                            <select name="jenis_kelamin" class="form-select" id="inputGroupSelect01">
                                <option selected="" value="{{ $user->jenis_kelamin }}">{{ $user->jenis_kelamin }}</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Agama </label>
                        <div class="input-group mb-3">
                            <select name="agama" class="form-select" id="inputGroupSelect01">
                                <option selected="" value="{{ $user->agama }}">{{ $user->agama }}</option>
                                <option value="Islam">Islam</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="col-md-4">
                    <div class="form-group col-md-12">
                        <label for="basicInput">Unit Kerja</label>
                        <div class="input-group mb-3">
                            <select name="unit_kerja_id" class="form-select" id="inputGroupSelect01">
                                <option selected="" value="{{ $user->unit_kerja_id }}">{{ $user->unitKerja->nama_unit_kerja }}</option>
                                @foreach($unit_kerja as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->nama_unit_kerja }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex flex-column align-items-end">
                        <button type="submit" class="btn icon icon-left btn-success "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg> Simpan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection