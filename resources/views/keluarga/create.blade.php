{{-- https://www.positronx.io/laravel-datatables-example/ --}}

@extends('layouts.app')
@section('action')

@endsection
@section('content')
<div class="nk-fmg-body-head d-none d-lg-flex">
    <div class="nk-fmg-search">
        <!-- <em class="icon ni ni-search"></em> -->
        <!-- <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search files, folders"> -->
        <h4 class="card-title text-primary"><i class='{{$icon}}' data-toggle='tooltip' data-placement='bottom' title='{{$subtitle}}'></i>  {{strtoupper($subtitle)}}</h4>
    </div>
    <div class="nk-fmg-actions">
        <div class="btn-group">
            <!-- <a href="#" target="_blank" class="btn btn-sm btn-success"><em class="icon ti-files"></em> <span>Export Data</span></a> -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDefault">Modal Default</button> -->
            <!-- <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalDefault"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="filtershow()"><em class="icon ti-file"></em> <span>Filter Data</span></a> -->
            <a href="{{ route('crud.keluarga', $pegawai->id) }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
        </div>
    </div>
</div>
<div class="row gy-3 d-none" id="loaderspin">
    <div class="col-md-12">
        <div class="col-md-12" align="center">
            &nbsp;
        </div>
        <div class="d-flex align-items-center">
          <div class="col-md-12" align="center">
            <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
          </div>
        </div>
        <div class="col-md-12" align="center">
            <strong>Loading...</strong>
        </div>
    </div>
</div>
<div class="card d-none" id="filterrow">
    <div class="card-body" style="background:#f7f9fd">
        <div class="row gy-3" >

        </div>
    </div>
    <!-- <div class="card-footer" style="background:#fff" align="right"> -->
    <div class="card-footer" style="background:#f7f9fd; padding-top:0px !important;">
        <div class="btn-group">
            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-dark" onclick="filterclear()"><em class="icon ti-eraser"></em> <span>Clear Filter</span></a> -->
            <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="filterdata()"><em class="icon ti-reload"></em> <span>Submit Filter</span></a>
        </div>
    </div>
</div>

<!-- <div class="nk-fmg-body-content"> -->
    <div class="nk-fmg-quick-list nk-block">
        <div class="card">
            <div class="card-body">

            <form  method="POST" action="{{ route('keluarga.store') }}" id='form1' enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" value="{{ $pegawai->id }}" name="pegawai_id">
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                            <label>Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required autofocus value="{{ old('nama') }}">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                            </div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" id="province" class="form-control">
                                <option value="">== Select Agama ==</option>
                                @foreach ($agama as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>

                                @error('agama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                            </div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                            <label>Jenjang Pendidikan</label>
                                {{-- <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" required autofocus value="{{ old('pendidikan') }}"> --}}
                                <select name="pendidikan" id="pendidikan" class="form-control">
                                    <option value="">== Select Pendidikan ==</option>
                                    @foreach ($pendidikan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('pendidikan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                            </div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                            <label>Pekerjaan</label>
                                {{-- <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" required autofocus value="{{ old('pendidikan') }}"> --}}
                                <select name="pekerjaan" id="pekerjaan" class="form-control">
                                    <option value="">== Select Pekerjaan ==</option>
                                    @foreach ($pekerjaan as $item)
                                        <option value="{{ $item->id }}">{{ $item->pekerjaan }}</option>
                                    @endforeach
                                </select>
                                @error('pekerjaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                            </div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                            <label>Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" required autofocus value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                            </div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                            <label>Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" required autofocus value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                            </div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                            <label>NIK</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" required autofocus value="{{ old('nik') }}">
                                @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                            </div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" id="" cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror" required autofocus >{{ old('alamat') }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                            </div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                            <label>Hubungan</label>
                                <select name="hubungan" class="form-control">
                                    <option value="">== Select Hubungan Keluarga ==</option>
                                    <option value="Ibu">Ibu</option>
                                    <option value="Ayah">Ayah</option>
                                    <option value="Anak">Anak</option>
                                </select>
                                @error('hubungan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                            </div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Anak Kandung ?</label>
                        <ul class="custom-control-group g-3 align-center">
                            <li>
                                <div class="custom-control custom-control-sm custom-checkbox">
                                    <input type="checkbox" class="custom-control-input @error('anakkandung') is-invalid @enderror" id="pay-card" name="anakkandung" required
                                    value="1">
                                    <label class="custom-control-label" for="pay-card">Anak Kandung</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                            <label>Golongan Darah</label>
                                {{-- <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" required autofocus value="{{ old('pendidikan') }}"> --}}
                                <select name="golongandarah" id="golongandarah" class="form-control">
                                    <option value="">== Select Golongan Darah ==</option>
                                    @foreach ($golongandarah as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('golongandarah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                            </div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end my-3">
                        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                        <button type="button" onclick='updateConfirmation()' class="btn btn-sm btn-success">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
<!-- </div> -->

@endsection
@push('script')
<script>
function updateConfirmation(){
    var flag = false
    CustomSwal.fire({
        icon:'question',
        text: 'Apakah Data Sudah Sesuai ?',
        showCancelButton: true,
        confirmButtonText: 'Simpan',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("form1").submit();
        }else{

        }
    });

}

</script>
@endpush
