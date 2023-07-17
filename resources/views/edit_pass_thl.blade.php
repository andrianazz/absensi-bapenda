@extends('layouts.main')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Password THL</h4>
    </div>

    <div class="card-body">
        <form action="/edit-pass-user/{{ $user->id }}/update" method="post">
            <div class="row">
                @csrf
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="basicInput">Password Baru</label>
                        <input name="password" type="text" class="form-control" id="basicInput" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Konfirmasi Password Baru</label>
                        <input name="password2" type="text" class="form-control" id="basicInput" placeholder="Konfirmasi Password Baru">
                    </div>
                    <div class="d-flex flex-column align-items-end">
                        <button type="submit" class="btn icon icon-left btn-success "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg> Simpan
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    
                </div>
            </div>
        </form>
    </div>
</div>

@endsection