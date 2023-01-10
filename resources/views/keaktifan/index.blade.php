@extends('layouts.app')
@section('content')
<div class="nk-fmg-body-head d-none d-lg-flex">
    <div class="nk-fmg-search">
        <h4 class="card-title text-primary">  Profile Karyawan</h4>
    </div>
</div>
<div class="nk-fmg-quick-list nk-block">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" style="width: 50%">
                    <tr>
                        <td>Kode Karyawan</td>
                        <td>:</td>
                        <td>{{ $pegawai->kode }}</td>
                    </tr>
                    <tr>
                        <td>Nama Karyawan</td>
                        <td>:</td>
                        <td>{{ $pegawai->nama }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="nk-fmg-quick-list nk-block">
    <div class="nk-fmg-body-head d-none d-lg-flex">
        <div class="nk-fmg-search">
            <h4 class="card-title text-primary"><i class="ni ni-dashlite" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Anggota Keluarga"></i>  RIWAYAT STRUKTURAL</h4>
        </div>
        <div class="nk-fmg-actions">
            <div class="btn-group">
                <a href="{{ route('keaktifan.create', $pegawai->id) }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-plus"></em> <span>Add Data</span></a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="small-table table " style="width:100%">
                    <thead style="color:#526484; font-size:11px;" class="thead-light">
                        <th width="1%">No.</th>
                        <th width="10%">No SK</th>
                        <th width="10%">Tanggal SK</th>
                        <th width="10%">Terhitung Mulai Tanggal</th>
                    </thead>
                    <tbody>
                        @foreach ($riwayatkeaktifan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->no_sk }}</td>
                                <td>{{ $item->tgl_sk }}</td>
                                <td>{{ $item->tmt_sk }}</td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
