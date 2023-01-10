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

            <form  method="POST" action="{{ route('keaktifan.update', $riwayatkeaktifan->riwayat_keaktifan_id) }}" id='form1' enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="form-group">
                            <label>Status Keaktifan</label>
                            <select name="nama_keaktifan" id="nama_keaktifan" class="form-control">
                                <option value="">== Select Status Keaktifan ==</option>
                                @foreach ($statuskeaktifan as $item)
                                <option value="{{ $item->id }}" {{ ($riwayatkeaktifan->status_keaktifan_id == $item->id) ? 'selected' : ''}}>{{ $item->nama_keaktifan}}</option>
                                @endforeach
                            </select>
                                @error('nama_keaktifan')
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
                            <label>No SK</label>
                                <input type="text" class="form-control @error('no_sk') is-invalid @enderror" name="no_sk" required autofocus value="{{ $riwayatkeaktifan->no_sk }}">
                            @error('no_sk')
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
                            <label>Terhitung Mulai Tanggal</label>
                                <input type="date" class="form-control @error('tmt_sk') is-invalid @enderror" name="tmt_sk" required autofocus value="{{ $riwayatkeaktifan->tmt_sk }}">
                                @error('tmt_sk')
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
                            <label>Tanggal SK</label>
                                <input type="date" class="form-control @error('tgl_sk') is-invalid @enderror" name="tgl_sk" required autofocus value="{{ $riwayatkeaktifan->tgl_sk }}">
                                @error('tgl_sk')
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
                            <label>Nama Penanda Tangan</label>
                                <input type="text" class="form-control @error('nama_penanda_tangan') is-invalid @enderror" name="nama_penanda_tangan" required autofocus value="{{ $riwayatkeaktifan->nama_penanda_tangan }}">
                            @error('nama_penanda_tangan')
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
                            <label>Jabatan Penanda Tangan</label>
                                <input type="text" class="form-control @error('jabatan_penanda_tangan') is-invalid @enderror" name="jabatan_penanda_tangan" required autofocus value="{{ $riwayatkeaktifan->jabatan_penanda_tangan }}">
                            @error('jabatan_penanda_tangan')
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
                            <label>NIP Penanda Tangan</label>
                                <input type="text" class="form-control @error('nip_penanda_tangan') is-invalid @enderror" name="nip_penanda_tangan" required autofocus value="{{ $riwayatkeaktifan->nip_penanda_tangan }}">
                            @error('nip_penanda_tangan')
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
