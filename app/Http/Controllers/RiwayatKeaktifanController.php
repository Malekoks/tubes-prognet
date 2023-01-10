<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\StatusKeaktifan;
use App\Models\RiwayatKeaktifan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RiwayatKeaktifanController extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Riwayat Keaktifan';
        $table_id = 'tbt_riwayat_keaktifan';
        return view('crud',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = RiwayatKeaktifan::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/crud/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->nama}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nama='{$data->nama}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(RiwayatKeaktifan::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create($id){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Riwayat Struktural';
        $pegawai = Pegawai::find($id);
        return view('keaktifan.create',compact('subtitle','icon'))->with(compact('pegawai'));
    }

    public function edit(Request $request){
        $data = RiwayatKeaktifan::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Pegawai';
        return view('edit',compact('subtitle','icon','data'));
    }

    public function riwayatKeaktifan(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        $riwayatkeaktifan = RiwayatKeaktifan::where('pegawai_id', $id)->get();
        return view('keaktifan.index')->with(compact('pegawai', 'riwayatkeaktifan'));
    }

    public function store(Request $request)
    {
         $riwayatkeaktifan = new RiwayatKeaktifan();
         $riwayatkeaktifan->pegawai_id = $request->pegawai_id;
         $riwayatkeaktifan->jabatan_struktural_id = $request->nama_jabatan_singkat;
         $riwayatkeaktifan->unit_id = $request->nama;
         $riwayatkeaktifan->sub_unit_id = $request->subunit;
         $riwayatkeaktifan->no_sk_diangkat = $request->pekerjaan;
         $riwayatkeaktifan->save();

         return redirect()->route('crud.struktur', $request->pegawai_id)->with(['success' => 'Data Berhasil Di Simpan !']);
     }
}
