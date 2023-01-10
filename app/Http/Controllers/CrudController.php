<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Pendidikan;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\StatusMenikah;
use App\Models\StatusPegawai;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\Hrd;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CrudController extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Pegawai';
        $table_id = 'tbm_pegawai';
        return view('pegawai.index',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = Hrd::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/crud/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->nama}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nama='{$data->nama}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    $aksi .= "<a title='Edit Data Keluarga' href='/crud/".$data->id."/keluarga' class='btn btn-md btn-secondary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-user' ></i></a>";
                    $aksi .= "<a title='Riwayat Struktur' href='/crud/".$data->id."/struktural' class='btn btn-md btn-secondary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-file' ></i></a>";
                    $aksi .= "<a title='Riwayat Keaktifan' href='/crud/".$data->id."/keaktifan' class='btn btn-md btn-secondary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-notepad' ></i></a>";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(Hrd::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create(Request $r)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Pegawai';

        $agama = Agama::select('id', 'nama')->get();
        $pendidikan = Pendidikan::select('id','nama')->get();
        $jabatan = Jabatan::select('jabatan_id','nama_jabatan_singkat')->get();
        $statusnikah = StatusMenikah::select('id','nama')->get();
        $statuspegawai = StatusPegawai::select('id','nama')->get();
        $jeniskelamin = jeniskelamin::select('id','nama')->get();

        return view('pegawai.create', compact('subtitle', 'icon'), [
            'agama' => $agama,
            'pendidikan' => $pendidikan,
            'jabatan' => $jabatan,
            'statusnikah' => $statusnikah,
            'statuspegawai' => $statuspegawai,
            'jeniskelamin' => $jeniskelamin
        ]);

    }

    public function edit(Request $request, $id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Pegawai';


        $pegawai = Pegawai::find($id);
        $agama = Agama::select('id', 'nama')->get();
        $pendidikan = Pendidikan::select('id','nama')->get();
        $jabatan = Jabatan::get();
        $statusnikah = StatusMenikah::select('id','nama')->get();
        $statuspegawai = StatusPegawai::select('id','nama')->get();
        $jeniskelamin = jeniskelamin::select('id','nama')->get();

        return view('pegawai.edit', compact('subtitle', 'icon'), [
            'agama' => $agama,
            'pendidikan' => $pendidikan,
            'jabatan' => $jabatan,
            'statusnikah' => $statusnikah,
            'statuspegawai' => $statuspegawai,
            'jeniskelamin' => $jeniskelamin,
            'pegawai' => $pegawai
        ]);

    }
    public function store(Request $request)
    {
        $pegawai = new Pegawai();
        $pegawai->kode = $request->kode;
        $pegawai->agama_id = $request->agama;
        $pegawai->pendidikan_terakhir_id = $request->pendidikan;
        $pegawai->jabatan_struktural_id = $request->jabatan;
        $pegawai->nama = $request->nama;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->nik = $request->nik;
        $pegawai->alamat = $request->alamat;
        $pegawai->status_nikah_id = $request->status_nikah;
        $pegawai->status_pegawai_id = $request->statuspegawai;
        $pegawai->jeniskelamin_id = $request->jeniskelamin;
        $pegawai->save();

        return redirect()->route('crud.list')->with(['success' => 'Data Berhasil Di Simpan !']);
    }

    // public function edit(Request $request){

    //     $validateData = $r->validate([
    //         'nama' => 'required',
    //         'dusun' => 'required',
    //         'alamat' => 'required',
    //     ]);

    //     $data = Hrd::find($request->id);
    //     $icon = 'ni ni-dashlite';
    //     $subtitle = 'Edit Data Pegawai';
    //     return view('edit',compact('subtitle','icon','data'));
    // }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->kode = $request->kode;
        $pegawai->agama_id = $request->agama;
        $pegawai->pendidikan_terakhir_id = $request->pendidikan;
        $pegawai->jabatan_struktural_id = $request->jabatan;
        $pegawai->nama = $request->nama;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->nik = $request->nik;
        $pegawai->alamat = $request->alamat;
        $pegawai->status_nikah_id = $request->status_nikah;
        $pegawai->status_pegawai_id = $request->statuspegawai;
        $pegawai->jeniskelamin_id = $request->jeniskelamin;
        $pegawai->update();

        return redirect()->route('crud.list')->with(['success' => 'Data Berhasil Di Update !']);
    }
}
