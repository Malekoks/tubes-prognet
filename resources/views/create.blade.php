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
            <a href="{{ route('crud.list') }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-arrow-left"></em> <span>Kembali</span></a>
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
           
            <form  method="POST" action="{{ route('crud.store') }}" id='form1' enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                            <label>Pegawai</label>
                                <input type="text" class="form-control @error('pegawai') is-invalid @enderror" name="pegawai" required autofocus value="{{ old('pegawai') }}">
                            @error('pegawai')
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
                            <select name="province" id="province" class="form-control">
                                <option value="">== Select Province ==</option>
                                @foreach ($agama as $id => $name)
                                    <option value="{{ $id }}">{{ $name->nama }}</option>
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
                                    @foreach ($pendidikan as $id => $name)
                                        <option value="{{ $id }}">{{ $name->nama }}</option>
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
                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan" required autofocus value="{{ old('pekerjaan') }}">
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
                                <input type="text" class="form-control @error('hubungan') is-invalid @enderror" name="hubungan" required autofocus value="{{ old('hubungan') }}">
                                @error('hubungan')
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
                            <label>Golongan Darah</label>
                                <input type="text" class="form-control @error('golongan_darah') is-invalid @enderror" name="golongan_darah" required autofocus value="{{ old('golongan_darah') }}">
                                @error('golongan_darah')
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
                            <label>Golongan Darah</label>
                                <input type="text" class="form-control @error('golongan_darah') is-invalid @enderror" name="golongan_darah" required autofocus value="{{ old('golongan_darah') }}">
                                @error('golongan_darah')
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
                            <label>Anak Kandung</label>
                                <input type="text" class="form-control @error('anak_kandung') is-invalid @enderror" name="anak_kandung" required autofocus value="{{ old('anak_kandung') }}">
                                @error('anak_kandung')
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
                            <label>Aktif</label>
                                <input type="text" class="form-control @error('aktif') is-invalid @enderror" name="aktif" required autofocus value="{{ old('aktif') }}">
                                @error('aktif')
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
                            <label>Balimed</label>
                                <input type="text" class="form-control @error('balimed') is-invalid @enderror" name="balimed" required autofocus value="{{ old('balimed') }}">
                                @error('balimed')
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
                            <label>Valid</label>
                                <input type="text" class="form-control @error('valid') is-invalid @enderror" name="valid" required autofocus value="{{ old('valid') }}">
                                @error('valid')
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
                                <label>Keterangan</label>
                                <textarea name="keterangan" id="" cols="30" rows="10" class="form-control @error('keterangan') is-invalid @enderror" required autofocus >{{ old('keterangan') }}</textarea>
                                @error('keterangan')
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
                            <label>Jenis Kelamin</label>
                                <input type="text" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required autofocus value="{{ old('jenis_kelamin') }}">
                                @error('jenis_kelamin')
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
                            <label>Akta Meninggal</label>
                                <input type="text" class="form-control @error('akta_meninggal') is-invalid @enderror" name="akta_meninggal" required autofocus value="{{ old('akta_meninggal') }}">
                                @error('akta_meninggal')
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
                            <label>Tanggal Meninggal</label>
                                <input type="date" class="form-control @error('tanggal_meninggal') is-invalid @enderror" name="tanggal_meninggal" required autofocus value="{{ old('tanggal_meninggal') }}">
                                @error('tanggal_meninggal')
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
                            <label>File Akta Meninggal</label>
                                <input type="file" class="form-control @error('file_akta_meninggal') is-invalid @enderror" name="file_akta_meninggal" required autofocus value="{{ old('file_akta_meninggal') }}">
                                @error('file_akta_meninggal')
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
