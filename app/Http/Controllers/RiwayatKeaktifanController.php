<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\StatusKeaktifan;
use App\Models\RiwayatKeaktifan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

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
        $statuskeaktifan = StatusKeaktifan::get();
        return view('keaktifan.create',compact('subtitle','icon'))->with(compact('pegawai','statuskeaktifan'));
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
         $riwayatkeaktifan->status_keaktifan_id = $request->nama_keaktifan;
         $riwayatkeaktifan->no_sk = $request->no_sk;
         $riwayatkeaktifan->tmt_sk = $request->tmt_sk;
         $riwayatkeaktifan->tgl_sk = $request->tgl_sk;
         $riwayatkeaktifan->nama_penanda_tangan = $request->nama_penanda_tangan;
         $riwayatkeaktifan->jabatan_penanda_tangan= $request->jabatan_penanda_tangan;
         $riwayatkeaktifan->nip_penanda_tangan = $request->nip_penanda_tangan;
         $riwayatkeaktifan->save();

         return redirect()->route('crud.keaktifan', $request->pegawai_id)->with(['success' => 'Data Berhasil Di Simpan !']);
     }

     public function destroy($id)
    {
        $status = false;
        try{
            DB::table('t_riwayat_keaktifan')
                ->where('riwayat_keaktifan_id', $id)->delete();
            $status = true;
            $message = "Data Telah di Hapus !";
            return response()->json([
                'status' => $status,
                'message' => $message
            ]);
        }catch(\Exception $e){

        }
    }

    public function editkeaktifan($id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Riwayat Keaktifan';
        $riwayatkeaktifan = RiwayatKeaktifan::find($id);
        $pegawai = Pegawai::find($id);
        $statuskeaktifan = StatusKeaktifan::get();
        return view('keaktifan.edit')->with(compact('icon','subtitle','riwayatkeaktifan', 'pegawai', 'statuskeaktifan'));
    }

    public function updatekeaktifan(Request $request, $id)
    {
        $riwayatkeaktifan = RiwayatKeaktifan::find($id);
        $riwayatkeaktifan->pegawai_id = $request->pegawai_id;
        $riwayatkeaktifan->status_keaktifan_id = $request->nama_keaktifan;
        $riwayatkeaktifan->no_sk = $request->no_sk;
        $riwayatkeaktifan->tmt_sk = $request->tmt_sk;
        $riwayatkeaktifan->tgl_sk = $request->tgl_sk;
        $riwayatkeaktifan->nama_penanda_tangan = $request->nama_penanda_tangan;
        $riwayatkeaktifan->jabatan_penanda_tangan= $request->jabatan_penanda_tangan;
        $riwayatkeaktifan->nip_penanda_tangan = $request->nip_penanda_tangan;
        $riwayatkeaktifan->update();

        return redirect()->route('crud.keaktifan', $riwayatkeaktifan->pegawai_id)->with(['success' => 'Data Berhasil Di Simpan !']);
    }

}
