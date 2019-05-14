<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Tahunajaran as Tahunajaran;
use App\Models\Detailsiswa as Detailsiswa;
use App\Models\Kelas as Kelas;
use App\Models\Siswa as Siswa;
use Illuminate\Support\Facades\DB;
use Excel;
use Response;

class KelasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->select('kelas.*','tahun_ajarans.tahun_ajaran')
        ->get();
        $aktif = DB::table('tahun_ajarans')->select('tahun_ajarans.id_tahun_ajaran')->where('tahun_ajarans.status','=','aktif')->get();
        $count = $aktif->count();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('kelas.index',array())
        ->with('kelas',$kelas)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('count',$count);
    }

    public function getShow($id_kelas)
    {
        $tahunajarannavbar = Tahunajaran::all();
        $detail = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','=','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->where('kelas.id_kelas','=',$id_kelas)
        ->select('siswas.*','detail_siswas.*')
        ->get();
        $no = 1;
        $kelas = Kelas::find($id_kelas);
        return view('kelas.show',array())
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('detail',$detail)
        ->with('no',$no)
        ->with('kelas',$kelas);
    }    

    public function getAdd(){
        $tahunajarannavbar = Tahunajaran::all();
        $tahunajaran = Tahunajaran::where('status','=','aktif')->pluck('tahun_ajaran')[0];;
        return view('kelas.add')
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('tahunajaran',$tahunajaran);
    }
    public function getSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tingkat_kelas' => 'required',
            'jurusan_kelas' => 'required',
            'kode_kelas' => 'required',
        ]); 
        if ($validator->fails()) {
            return redirect('sarpras/kelas/add')
                ->withErrors($validator)
                ->withInput();
        }

        $kelas = new Kelas;
        $kelas->tingkat_kelas = Input::get('tingkat_kelas');
        $kelas->jurusan_kelas = Input::get('jurusan_kelas');
        $kelas->kode_kelas = Input::get('kode_kelas');
        $tahunajaran = Tahunajaran::where('status','=','aktif')->pluck('id_tahun_ajaran')[0];;
        $kelas->id_tahun_ajaran = $tahunajaran;
        $kelas->save();
        
        return redirect('sarpras/kelas')->with('sukses_simpan','yes');
    }

    public function getDelete($id_kelas)
    {
        Kelas::find($id_kelas)->delete();
        return redirect('sarpras/kelas')->with('sukses_hapus','yes');
    }


    public function getEdit($id_kelas)
    {
        $kelas = Kelas::find($id_kelas);
        $tahunajarannavbar = Tahunajaran::all();
        return view('kelas.edit')
        ->with('kelas',$kelas)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }
    public function getUpdate($id_kelas, Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'tingkat_kelas' => 'required',
            'jurusan_kelas' => 'required',
            'kode_kelas' => 'required',
        ]);   
        if ($validator->fails()) {
            return redirect('sarpras/kelas/edit')
                ->withErrors($validator)
                ->withInput();
        }
        
        $kelas = Kelas::find($id_kelas);
        $kelas->tingkat_kelas = Input::get('tingkat_kelas');
        $kelas->jurusan_kelas = Input::get('jurusan_kelas');
        $kelas->kode_kelas = Input::get('kode_kelas');
        $kelas->save();
        
        return redirect('sarpras/kelas')->with('sukses_update','yes');
    }

    public function getLock($id_kelas, Request $request)
    {
        
        $kelas = Kelas::find($id_kelas);
        
        $kelas->aksi = "terkunci";
        
        $kelas->save();
        
        return redirect('sarpras/kelas')->with('sukses_kunci','yes');

    }

    public function lockAll()
    {
        $kelas = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->select('kelas.id_kelas')
        ->get();
        foreach ($kelas as $k) {
            $id = Kelas::find($k->id_kelas);

            $id->aksi = "terkunci";
        
            $id->save();
        }
        
        return redirect('sarpras/kelas')->with('sukses_kunci','yes');

    }

    public function getAddSiswa($id_kelas){
        $tahunajarannavbar = Tahunajaran::all();
        $kelas = Kelas::where('id_kelas','=',$id_kelas)->get();
        $siswa = DB::table('siswas')
        ->where('status','=','aktif')
        ->whereNotIn('nis',function($q){
            $q->select(DB::raw('detail_siswas.nis FROM detail_siswas INNER JOIN kelas ON detail_siswas.id_kelas = kelas.id_kelas INNER JOIN tahun_ajarans ON kelas.id_tahun_ajaran = tahun_ajarans.id_tahun_ajaran WHERE tahun_ajarans.status = "aktif"'));
        })
        ->get();
        return view('kelas.addsiswa')
        ->with('kelas',$kelas)
        ->with('siswa',$siswa)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }
    public function getSaveSiswa(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
        ]);   
        if ($validator->fails()) {
            return redirect('sarpras/kelas/addsiswa')
                ->withErrors($validator)
                ->withInput();
        }
        
        $detailsiswa = new Detailsiswa;
        $detailsiswa->nis = Input::get('nis');
        $detailsiswa->save();
        return redirect('sarpras/kelas')->with('sukses_simpan','yes');
    }


    public function TemplateSiswaByKelas(){
        $path = public_path()."/download/tambah_siswa_by_kelas.xls";
        return Response::download($path, 'tambah_siswa_by_kelas.xls');
    }
    public function SaveSiswaImport(Request $request)
    {
        if($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $ds = new Detailsiswa();
                    $ds->nis = $value->nis;
                    $ds->id_kelas = Input::get('id_kelas');
                    $ds->save();
                }
            }
        }
    return back()->with('sukses_simpan_siswa','yes');
    }


    public function TemplateKelas(){
        $path = public_path()."/download/tambah_kelas.xls";
        return Response::download($path, 'tambah_kelas.xls');
    }
    public function getImport(Request $request){
        $id_tahun_ajaran = Tahunajaran::where('status','=','aktif')->pluck('id_tahun_ajaran')[0];;
        if($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $kelas = new Kelas();
                    $kelas->tingkat_kelas = $value->tingkat_kelas;
                    $kelas->jurusan_kelas = $value->jurusan_kelas;
                    $kelas->kode_kelas = $value->kode_kelas;
                    $kelas->id_tahun_ajaran = $id_tahun_ajaran;
                    $kelas->save();
                }
            }
        }
    return back()->with('sukses_import','yes');
    }

    

}