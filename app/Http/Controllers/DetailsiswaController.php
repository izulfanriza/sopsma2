<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Tahunajaran as Tahunajaran;
use App\Models\Detailsiswa as Detailsiswa;
use App\Models\Siswa as Siswa;
use App\Models\Kelas as Kelas;
use Illuminate\Support\Facades\DB;
use Excel;
use Response;

class DetailsiswaController extends Controller
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
        $detailsiswa = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','=','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->select('detail_siswas.*','siswas.nama_siswa','kelas.id_kelas','kelas.tingkat_kelas','kelas.jurusan_kelas','kelas.kode_kelas')
        ->orderBy('kelas.id_kelas','asc')
        ->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('detailsiswa.index',array())
        ->with('detailsiswa',$detailsiswa)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }

    public function index1()
    {
        $detailsiswa = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','=','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->whereNull('detail_siswas.nominal_sop')
        ->select('detail_siswas.*','siswas.nama_siswa','kelas.id_kelas','kelas.tingkat_kelas','kelas.jurusan_kelas','kelas.kode_kelas')
        ->orderBy('kelas.id_kelas','asc')
        ->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('detailsiswa.belumisinominal',array())
        ->with('detailsiswa',$detailsiswa)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }

    public function export1()
    {
        $detailsiswa = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->whereNull('detail_siswas.nominal_sop')
        ->select('detail_siswas.id_detail_siswa','siswas.nis','siswas.nama_siswa','kelas.tingkat_kelas','kelas.jurusan_kelas','kelas.kode_kelas','detail_siswas.nominal_sop')
        ->orderBy('kelas.id_kelas')
        ->get();
        $data = array();
        foreach ($detailsiswa as $ds) {
           $data[] = (array)$ds;
        }
        return Excel::create('Form Nominal SOP', function($excel) use ($data){
            $excel->sheet('detailsiswa', function($sheet) use ($data){
                $sheet->fromArray($data);
            });
        })->export('xlsx');
    }

    public function import1(Request $request){
        if($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $detailsiswa = Detailsiswa::find($value->id_detail_siswa);
                    $detailsiswa->nominal_sop = $value->nominal_sop;        
                    $detailsiswa->save();
                }
            }
        }
    return redirect('sarpras/detailsiswa2')->with('sukses_import','yes');
    }

    public function index2()
    {
        $detailsiswa = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','=','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('detail_siswas.nominal_sop','!=','-1')
        ->where('detail_siswas.aksi','=','tidak-terkunci')
        ->select('detail_siswas.*','siswas.nama_siswa','kelas.id_kelas','kelas.tingkat_kelas','kelas.jurusan_kelas','kelas.kode_kelas')
        ->orderBy('kelas.id_kelas','asc')
        ->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('detailsiswa.nominalbelumterkunci',array())
        ->with('detailsiswa',$detailsiswa)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function index3()
    {
        $detailsiswa = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','=','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('detail_siswas.aksi','=','terkunci')
        ->select('detail_siswas.*','siswas.nama_siswa','kelas.id_kelas','kelas.tingkat_kelas','kelas.jurusan_kelas','kelas.kode_kelas')
        ->orderBy('kelas.id_kelas','asc')
        ->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('detailsiswa.nominalterkunci',array())
        ->with('detailsiswa',$detailsiswa)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }

    public function getAdd(){
        $siswa = Siswa::where('status','=','aktif')->get();
        $kelas = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.aksi','=','terkunci')
        ->select('kelas.*')
        ->get();
        $tahunajarannavbar = Tahunajaran::all();
        return view('detailsiswa.add',array())
        ->with('siswa',$siswa)
        ->with('kelas',$kelas)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }
    public function getUpdate($id_detail_siswa, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
            'id_kelas' => 'required',
            'nominal_sop' => 'required|numeric|min:0',
        ]);   
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $detailsiswa = Detailsiswa::find($id_detail_siswa);
        $detailsiswa->nis = Input::get('nis');
        $detailsiswa->id_kelas = Input::get('id_kelas');
        $detailsiswa->nominal_sop = Input::get('nominal_sop');        
        $detailsiswa->save();
        
        return redirect('sarpras/detailsiswa2')->with('sukses_update','yes');
    }

    public function getSave(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
            'id_kelas' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $detailsiswa = new Detailsiswa;
        
        $detailsiswa->nis = Input::get('nis');
        $detailsiswa->id_kelas = Input::get('id_kelas');
        $detailsiswa->nominal_sop = Input::get('nominal_sop');
        
        $detailsiswa->save();
        $id_kelas = Input::get('id_kelas');
        
        return redirect('sarpras/kelas/show/'.$id_kelas)->with('sukses_simpan','yes');

    }

    public function getDelete($id_detail_siswa)
    {
        Detailsiswa::find($id_detail_siswa)->delete();
        return back()->with('sukses_hapus','yes');
    }


    public function getEdit($id_detail_siswa)
    {
        $detailsiswa = Detailsiswa::find($id_detail_siswa);
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        $tahunajarannavbar = Tahunajaran::all();
        return view('detailsiswa.edit')
        ->with('detailsiswa',$detailsiswa)
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('siswa',$siswa)
        ->with('kelas',$kelas);

        // $tahunajarannavbar = Tahunajaran::all();
        // return view('tahunajaran.add',array())->with('tahunajarannavbar',$tahunajarannavbar);
    }



    


    public function getLock($id_detail_siswa, Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
            'id_kelas' => 'required',
            'nominal_sop' => 'required',
        ]);
        $detailsiswa = Detailsiswa::find($id_detail_siswa);
        
        // $data->nama_field_di_database = Input::get('nama_field_di_form');
        $detailsiswa->aksi = "terkunci";
        
        $detailsiswa->save();
        
        return redirect('sarpras/detailsiswa3')->with('sukses_kunci','yes');

    }

    public function lockAll()
    {
        $detailsiswa = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','=','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('detail_siswas.nominal_sop','!=','')
        ->where('detail_siswas.aksi','=','tidak-terkunci')
        ->select('detail_siswas.id_detail_siswa')
        ->get();
        foreach ($detailsiswa as $ds) {
            $id = Detailsiswa::find($ds->id_detail_siswa);

            $id->aksi = "terkunci";
        
            $id->save();
        }
        
        return redirect('sarpras/detailsiswa3')->with('sukses_kunci','yes');

    }

}
