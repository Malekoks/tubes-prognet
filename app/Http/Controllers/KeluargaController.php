<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Pegawai;
use App\Models\Agama;
use App\Models\Pendidikan;
use App\Models\Pekerjaan;
use App\Models\GolonganDarah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class KeluargaController extends Controller
{

    public function index(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Keluarga';
        $table_id = 'tbm_anggota_keluarga';
        return view('crud',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = Keluarga::all();
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
        if(Keluarga::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create($id){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Keluarga';
        $pegawai = Pegawai::find($id);
        $agama = Agama::get();
        $pekerjaan = Pekerjaan::get();
        $golongandarah = GolonganDarah::get();
        $pendidikan = Pendidikan::select('id','nama')->get();
        return view('keluarga.create',compact('subtitle','icon'))->with(compact('pegawai', 'agama', 'pendidikan', 'pekerjaan', 'golongandarah'));
    }

    public function edit(Request $request){
        $data = Keluarga::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Pegawai';
        return view('edit',compact('subtitle','icon','data'));
    }

    public function profileKaryawan(Request $request, $id)
    {
        $pegawai = DB::table('m_pegawai')
                    ->select('m_pegawai.id','m_pegawai.kode', 'm_pegawai.nama','m_agama.nama as nama_agama', 'm_pendidikan.nama as nama_pendidikan', 'm_pegawai.nik', 'm_pegawai.tempat_lahir','m_pegawai.alamat')
                    ->leftJoin('m_agama', 'm_pegawai.agama_id', '=', 'm_agama.id')
                    ->leftJoin('m_pendidikan', 'm_pegawai.pendidikan_terakhir_id', '=', 'm_pendidikan.id')
                    ->where('m_pegawai.id', $id)->first();
        $keluarga = Keluarga::where('pegawai_id', $id)->orderBy('id_anggota_keluarga', 'DESC')->get();
        return view('pegawai.profile')->with(compact('pegawai', 'keluarga'));
    }

    public function store(Request $request)
    {
        $keluarga = new Keluarga();
        $keluarga->pegawai_id = $request->pegawai_id;
        $keluarga->agama_id = $request->agama;
        $keluarga->nama = $request->nama;
        $keluarga->jenjang_pendidikan_id = $request->pendidikan;
        $keluarga->pekerjaan_id = $request->pekerjaan;
        $keluarga->tempat_lahir = $request->tempat_lahir;
        $keluarga->tanggal_lahir = $request->tanggal_lahir;
        $keluarga->nik = $request->nik;
        $keluarga->alamat = $request->alamat;
        $keluarga->hubungan = $request->hubungan;
        $keluarga->golongan_darah_id = $request->golongandarah;
        $keluarga->is_anak_kandung = (empty($request->anakkandung)) ? 0 : 1;
        $keluarga->save();

        return redirect()->route('crud.keluarga', $request->pegawai_id)->with(['success' => 'Data Berhasil Di Simpan !']);
    }

    public function destroy($id)
    {
        $status = false;
        try{
            DB::table('m_anggota_keluarga')
                ->where('id_anggota_keluarga', $id)->delete();
            $status = true;
            $message = "Data Telah di Hapus !";
            return response()->json([
                'status' => $status,
                'message' => $message
            ]);
        }catch(\Exception $e){

        }
    }

    public function editkeluarga($id)
    {
        $keluarga = Keluarga::find($id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Keluarga';
        $agama = Agama::get();
        $pekerjaan = Pekerjaan::get();
        $golongandarah = GolonganDarah::get();
        $pendidikan = Pendidikan::select('id','nama')->get();
        return view('keluarga.edit')->with(compact('keluarga', 'icon', 'subtitle','agama', 'pekerjaan', 'golongandarah','pendidikan'));
    }

    public function updatekeluarga(Request $request, $id)
    {
        $keluarga = Keluarga::find($id);
        $keluarga->agama_id = $request->agama;
        $keluarga->nama = $request->nama;
        $keluarga->jenjang_pendidikan_id = $request->pendidikan;
        $keluarga->pekerjaan_id = $request->pekerjaan;
        $keluarga->tempat_lahir = $request->tempat_lahir;
        $keluarga->tanggal_lahir = $request->tanggal_lahir;
        $keluarga->nik = $request->nik;
        $keluarga->alamat = $request->alamat;
        $keluarga->hubungan = $request->hubungan;
        $keluarga->golongan_darah_id = $request->golongandarah;
        $keluarga->is_anak_kandung = (empty($request->anakkandung)) ? 0 : 1;
        $keluarga->update();

        return redirect()->route('crud.keluarga', $keluarga->pegawai_id)->with(['success' => 'Data Berhasil Di Simpan !']);
    }
}

