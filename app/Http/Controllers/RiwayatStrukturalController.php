<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\UnitMedik;
use App\Models\SubUnitMedik;
use App\Models\JabatanStruktural;
use App\Models\RiwayatStruktural;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
        $pegawai = Pegawai::find($id);
        $riwayatstruktural = RiwayatStruktural::where('pegawai_id', $id)->get();
        return view('struktural.index')->with(compact('pegawai', 'riwayatstruktural'));
    }

    public function store(Request $request)
    {
        $riwayatstruktural = new RiwayatStruktural();
        $riwayatstruktural->pegawai_id = $request->pegawai_id;
        $riwayatstruktural->jabatan_struktural_id = $request->nama_jabatan_singkat;
        $riwayatstruktural->unit_id = $request->nama;
        $riwayatstruktural->sub_unit_id = $request->subunit;
        $riwayatstruktural->no_sk_diangkat = $request->pekerjaan;
        $riwayatstruktural->save();

        return redirect()->route('crud.struktural', $request->pegawai_id)->with(['success' => 'Data Berhasil Di Simpan !']);
    }
}
