<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\UnitMedik;
use App\Models\SubUnitMedik;
use App\Models\JabatanStruktural;
use App\Models\RiwayatStruktural;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RiwayatStrukturalController extends Controller
{
    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Riwayat Struktural';
        $table_id = 'tbt_riwayat_struktural';
        return view('crud',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = RiwayatStruktural::all();
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
        if(RiwayatStruktural::destroy($request->id)){
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
        $unitmedik = UnitMedik::get();
        $subunitmedik = SubUnitMedik::get();
        $jabatanstruktural = JabatanStruktural::get();
        return view('struktural.create',compact('subtitle','icon'))->with(compact('pegawai', 'unitmedik', 'subunitmedik', 'jabatanstruktural'));
    }

    public function edit(Request $request){
        $data = RiwayatStruktural::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Pegawai';
        return view('edit',compact('subtitle','icon','data'));
    }

    public function riwayatStruktural(Request $request, $id)
    {
        $pegawai = DB::table('m_pegawai')
                    ->select('m_pegawai.id','m_pegawai.kode', 'm_pegawai.nama','m_agama.nama as nama_agama', 'm_pendidikan.nama as nama_pendidikan', 'm_pegawai.nik', 'm_pegawai.tempat_lahir','m_pegawai.alamat')
                    ->leftJoin('m_agama', 'm_pegawai.agama_id', '=', 'm_agama.id')
                    ->leftJoin('m_pendidikan', 'm_pegawai.pendidikan_terakhir_id', '=', 'm_pendidikan.id')
                    ->where('m_pegawai.id', $id)->first();
        $riwayatstruktural = RiwayatStruktural::where('pegawai_id', $id)->orderBy('riwayat_struktural_id', 'DESC')->get();
        return view('struktural.index')->with(compact('pegawai', 'riwayatstruktural'));
    }

    public function store(Request $request)
    {
        $riwayatstruktural = new RiwayatStruktural();
        $riwayatstruktural->pegawai_id = $request->pegawai_id;
        $riwayatstruktural->jabatan_struktural_id = $request->nama_jabatan_singkat;
        $riwayatstruktural->unit_id = $request->nama;
        $riwayatstruktural->sub_unit_id = $request->nama_subunit;
        $riwayatstruktural->no_sk_diangkat = $request->no_sk_diangkat;
        $riwayatstruktural->tmt_sk_diangkat = $request->tmt_sk_diangkat;
        $riwayatstruktural->tgl_sk_diangkat = $request->tgl_sk_diangkat;
        $riwayatstruktural->no_sk_berhenti = $request->no_sk_berhenti;
        $riwayatstruktural->tmt_sk_berhenti = $request->tmt_sk_berhenti;
        $riwayatstruktural->tgl_sk_berhenti = $request->tgl_sk_berhenti;
        $riwayatstruktural->tgl_sk_berakhir = $request->tgl_sk_berakhir;
        $riwayatstruktural->nama_penanda_tangan_pengangkat = $request->nama_penanda_tangan_pengangkat;
        $riwayatstruktural->jabatan_penanda_tangan_pengangkat = $request->jabatan_penanda_tangan_pengangkat;
        $riwayatstruktural->nip_penanda_tangan_pengangkat = $request->nip_penanda_tangan_pengangkat;
        $riwayatstruktural->nama_penanda_tangan_berhenti = $request->nama_penanda_tangan_berhenti;
        $riwayatstruktural->jabatan_penanda_tangan_berhenti = $request->jabatan_penanda_tangan_berhenti;
        $riwayatstruktural->nip_penanda_tangan_berhenti = $request->nip_penanda_tangan_berhenti;
        $riwayatstruktural->keterangan = $request->keterangan;
        $riwayatstruktural->save();

        return redirect()->route('crud.struktural', $request->pegawai_id)->with(['success' => 'Data Berhasil Di Simpan !']);
    }

    public function destroy($id)
    {
        $status = false;
        try{
            DB::table('t_riwayat_struktural')
                ->where('riwayat_struktural_id', $id)->delete();
            $status = true;
            $message = "Data Telah di Hapus !";
            return response()->json([
                'status' => $status,
                'message' => $message
            ]);
        }catch(\Exception $e){

        }
    }

    public function editstruktural($id)
    {
        $riwayatstruktural = RiwayatStruktural::find($id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Riwayat Struktural';
        $pegawai = Pegawai::find($id);
        $unitmedik = UnitMedik::get();
        $subunitmedik = SubUnitMedik::get();
        $jabatanstruktural = JabatanStruktural::get();
        return view('struktural.edit', compact('riwayatstruktural', 'icon','subtitle', 'pegawai', 'unitmedik', 'subunitmedik', 'jabatanstruktural'));
    }

    public function updatestruktural(Request $request, $id)
    {
        $riwayatstruktural = RiwayatStruktural::find($id);
        $riwayatstruktural->jabatan_struktural_id = $request->nama_jabatan_singkat;
        $riwayatstruktural->unit_id = $request->nama;
        $riwayatstruktural->sub_unit_id = $request->nama_subunit;
        $riwayatstruktural->no_sk_diangkat = $request->no_sk_diangkat;
        $riwayatstruktural->tmt_sk_diangkat = $request->tmt_sk_diangkat;
        $riwayatstruktural->tgl_sk_diangkat = $request->tgl_sk_diangkat;
        $riwayatstruktural->no_sk_berhenti = $request->no_sk_berhenti;
        $riwayatstruktural->tmt_sk_berhenti = $request->tmt_sk_berhenti;
        $riwayatstruktural->tgl_sk_berhenti = $request->tgl_sk_berhenti;
        $riwayatstruktural->tgl_sk_berakhir = $request->tgl_sk_berakhir;
        $riwayatstruktural->nama_penanda_tangan_pengangkat = $request->nama_penanda_tangan_pengangkat;
        $riwayatstruktural->jabatan_penanda_tangan_pengangkat = $request->jabatan_penanda_tangan_pengangkat;
        $riwayatstruktural->nip_penanda_tangan_pengangkat = $request->nip_penanda_tangan_pengangkat;
        $riwayatstruktural->nama_penanda_tangan_berhenti = $request->nama_penanda_tangan_berhenti;
        $riwayatstruktural->jabatan_penanda_tangan_berhenti = $request->jabatan_penanda_tangan_berhenti;
        $riwayatstruktural->nip_penanda_tangan_berhenti = $request->nip_penanda_tangan_berhenti;
        $riwayatstruktural->keterangan = $request->keterangan;
        $riwayatstruktural->update();

        return redirect()->route('crud.struktural', $riwayatstruktural->pegawai_id)->with(['success' => 'Data Berhasil Di Simpan !']);
    }

}
