<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Tahunajaran as Tahunajaran;
use App\Models\Siswa as Siswa;
use Illuminate\Support\Facades\DB;
use Excel;
use Response;

class SiswaController extends Controller
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
    public function aindex()
    {
        $siswa = DB::table('siswas')
        ->where('siswas.status','=','aktif')
        ->select('siswas.*')
        ->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('siswa.aindex',array())
        ->with('siswa',$siswa)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }

    public function nindex()
    {
        $siswa = DB::table('siswas')
        ->where('siswas.status','=','non-aktif')
        ->select('siswas.*')
        ->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('siswa.nindex',array())
        ->with('siswa',$siswa)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function getShow($nis)
    {
        $siswa = Siswa::find($nis);
        $tahunajarannavbar = Tahunajaran::all();
        return view('siswa.show',array())
        ->with('siswa',$siswa)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }

    public function getAdd(){
        $tahunajarannavbar = Tahunajaran::all();
        return view('siswa.add',array())->with('tahunajarannavbar',$tahunajarannavbar);
    }
    public function getSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:siswas',
            'nama_siswa' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'nama_wali' => 'required',
            'no_hp_wali' => 'required',
        ]);    
        if ($validator->fails()) {
            return redirect('sarpras/siswa/add')
                ->withErrors($validator)
                ->withInput();
        }
        
        $siswa = new Siswa;
        $siswa->nis = Input::get('nis');
        $siswa->nama_siswa = Input::get('nama_siswa');
        $siswa->jenis_kelamin = Input::get('jenis_kelamin');
        $siswa->alamat = Input::get('alamat');
        $siswa->tempat_lahir = Input::get('tempat_lahir');
        $siswa->tanggal_lahir = Input::get('tanggal_lahir');
        $siswa->nama_wali = Input::get('nama_wali');
        $siswa->no_hp_wali = Input::get('no_hp_wali');
        $siswa->save();
        
        return redirect('sarpras/siswaaktif')->with('sukses_simpan','yes');
    }

    public function getAddNonaktif(){
        $siswa = Siswa::where('status','aktif')
        ->orderBy('nis', 'asc')->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('siswa.addnonaktif',array())
        ->with('siswa',$siswa)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }
    public function getNonaktif($nis, Request $require)
    {
        $siswa = Siswa::where('status','non-aktif')
        ->orderBy('nis', 'asc')->get();
        $nis = Siswa::find($nis);
        $nis->status = 'non-aktif';
        $nis->save();
        $tahunajarannavbar = Tahunajaran::all();

        return redirect('sarpras/siswanonaktif')
        ->with('sukses_nonaktif','yes')
        ->with('siswa',$siswa)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }

    public function getDelete($nis)
    {
        Siswa::find($nis)->delete();
        return redirect('sarpras/siswaaktif')->with('sukses_hapus','yes');
    }

    public function deleteAll()
    {
        Siswa::where('status','=','non-aktif')->delete();
        return redirect('sarpras/siswanonaktif')->with('sukses_hapus','yes');
    }

    public function getEdit($nis)
    {
        $siswa = Siswa::find($nis);
        $tahunajarannavbar = Tahunajaran::all();
        return view('siswa.edit')
        ->with('siswa',$siswa)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }
    public function getUpdate($nis, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
            'nama_siswa' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'nama_wali' => 'required',
            'no_hp_wali' => 'required|max:50',
        ]);
        $siswa = Siswa::find($nis);
        if ($validator->fails()) {
            return redirect('sarpras/siswa/edit/'.$siswa->nis)
                ->withErrors($validator)
                ->withInput();
        }
        
        $siswa->nis = Input::get('nis');
        $siswa->nama_siswa = Input::get('nama_siswa');
        $siswa->jenis_kelamin = Input::get('jenis_kelamin');
        $siswa->alamat = Input::get('alamat');
        $siswa->tempat_lahir = Input::get('tempat_lahir');
        $siswa->tanggal_lahir = Input::get('tanggal_lahir');
        $siswa->nama_wali = Input::get('nama_wali');
        $siswa->no_hp_wali = Input::get('no_hp_wali');
        $siswa->save();
        return redirect('sarpras/siswa/show/'.$siswa->nis)->with('sukses_update','yes');
    }

        // $siswa = Siswa::select('nis','nama_siswa','jenis_kelamin','alamat','tempat_lahir','tanggal_lahir','nama_siswa','nama_wali','no_hp_wali')->limit(1)->get();
        // return Excel::create('data_siswa', function($excel) use ($siswa){
        //     $excel->sheet('mysheet', function($sheet) use ($siswa){
        //         $sheet->fromArray($siswa);
        //     });
        // })->download('xls');

    public function TemplateSiswa(){
        $path = public_path()."/download/tambah_siswa.xls";
        return Response::download($path, 'tambah_siswa.xls');
    }
    public function getImport(Request $request){
        if($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $siswa = new Siswa();
                    $siswa->nis = $value->nis;
                    $siswa->nama_siswa = $value->nama_siswa;
                    $siswa->jenis_kelamin = $value->jenis_kelamin;
                    $siswa->alamat = $value->alamat;
                    $siswa->tempat_lahir = $value->tempat_lahir;
                    $siswa->tanggal_lahir = $value->tanggal_lahir;
                    $siswa->nama_wali = $value->nama_wali;
                    $siswa->no_hp_wali = $value->no_hp_wali;
                    $siswa->save();
                }
            }
        }
    return back()->with('sukses_import','yes');
    }

    public function getNonExport(){
        $path = public_path()."/download/tambah_siswa.xls";
        return Response::download($path, 'tambah_siswa.xls');
    }
    public function getNonImport(Request $request){
        if($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $siswa = Siswa::find($value->nis);
                    $siswa->status = 'non-aktif';
                    $siswa->save();
                }
            }
        }
    return back()->with('sukses_import_non','yes');
    }


}
