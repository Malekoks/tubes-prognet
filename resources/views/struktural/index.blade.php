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
                    <tr>
                        <td>NIK Karyawan</td>
                        <td>:</td>
                        <td>{{ $pegawai->nik }}</td>
                    </tr>
                    <tr>
                        <td>Agama Karyawan</td>
                        <td>:</td>
                        <td>{{ $pegawai->nama_agama }}</td>
                    </tr>
                    <tr>
                        <td>Jenjang Pendidikan Karyawan</td>
                        <td>:</td>
                        <td>{{ $pegawai->nama_pendidikan }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir Karyawan</td>
                        <td>:</td>
                        <td>{{ $pegawai->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Karyawan</td>
                        <td>:</td>
                        <td>{{ $pegawai->alamat }}</td>
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
                <a href="{{ route('struktural.create', $pegawai->id) }}" class="btn btn-sm btn-primary" onclick="buttondisable(this)"><em class="icon fas fa-plus"></em> <span>Add Data</span></a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="small-table table " style="width:100%">
                    <thead style="color:#526484; font-size:11px;" class="thead-light">
                        <th width="1%">No.</th>
                        <th width="10%">No SK Diangkat</th>
                        <th width="10%">Terhitung Mulai Tanggal</th>
                        <th width="10%">Tanggal SK Diangkat</th>
                        <th width="10%">No SK Berhenti</th>
                        <th width="10%">Terhitung Mulai Tanggal</th>
                        <th width="10%">Tanggal SK Berhenti</th>
                        <th width="10%">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($riwayatstruktural as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->no_sk_diangkat }}</td>
                                <td>{{ $item->tmt_sk_diangkat }}</td>
                                <td>{{ $item->tgl_sk_diangkat }}</td>
                                <td>{{ $item->no_sk_berhenti }}</td>
                                <td>{{ $item->tmt_sk_berhenti }}</td>
                                <td>{{ $item->tgl_sk_berhenti }}</td>
                                <td>
                                    <a title="Edit Data" href="{{ route('struktural.edit', $item->riwayat_struktural_id) }}" class='btn btn-md btn-primary edit'><i class='ti-pencil' ></i></a>
                                    <a title="Delete Data" href="javascript:void(0)" class="btn btn-md btn-danger delete" data-id="{{$item->riwayat_struktural_id}}" data-nama="{{$item->nama}}"><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a>
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
@push('script')
<script>
    @if ($message = Session::get('success'))
        CustomSwal.fire('Sukses', '{{ $message }}', 'success');
    @endif
    $(document).on('click', '.delete', function(e){
        let nama = $(this).data('nama');
        let id = $(this).data('id')
        CustomSwal.fire({
            icon:'question',
            text: 'Hapus Data '+nama+' ?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"{{url('/struktural')}}/"+id,
                    data:{
                        _method:"DELETE",
                        _token:"{{csrf_token()}}"
                    },
                    type:"POST",
                    dataType:"JSON",
                    success:function(data){
                        if(data.status){
                            CustomSwal.fire('Sukses', data.message, 'success').then(() => {
                                location.reload();
                            });
                        }else{
                            CustomSwal.fire('Gagal', data.message, 'error');
                        }
                    },
                    error:function(error){
                        CustomSwal.fire('Gagal', 'terjadi kesalahan sistem', 'error');
                        console.log(error.XMLHttpRequest);
                    }
                });
            }else{

            }
        });
    });
</script>
@endpush
