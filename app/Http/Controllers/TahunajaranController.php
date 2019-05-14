<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Tahunajaran as Tahunajaran;
use Illuminate\Support\Facades\DB;

class TahunajaranController extends Controller
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
        $tahunajaran = DB::table('tahun_ajarans')
        ->select('tahun_ajarans.*')
        ->orderBy('id_tahun_ajaran','desc')
        ->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('tahunajaran.index',array())
        ->with('tahunajaran',$tahunajaran)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }

    public function getAdd(){
        $tahunajarannavbar = Tahunajaran::all();
        return view('tahunajaran.add',array())->with('tahunajarannavbar',$tahunajarannavbar);
    }
    public function getSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_ajaran' => 'required',
            'tanggal_mulai' => 'required|date_format:Y-m-d',
            'tanggal_selesai' => 'required|date_format:Y-m-d',
        ]);
        if ($validator->fails()) {
            return redirect('sarpras/tahunajaran/add')
                ->withErrors($validator)
                ->withInput();
        }
        $tanggal_mulai = Input::get('tanggal_mulai');
        $tanggal_selesai = Input::get('tanggal_selesai');
        if ($tanggal_mulai > $tanggal_selesai) {
            return redirect('sarpras/tahunajaran/add')
                ->withErrors('Tanggal Mulai Atau Tanggal Selesai Tidak Valid')
                ->withInput();
        }

        $tahunajaran = new Tahunajaran;
        $tahunajaran->tahun_ajaran = Input::get('tahun_ajaran');
        $tahunajaran->tanggal_mulai = Input::get('tanggal_mulai');
        $tahunajaran->tanggal_selesai = Input::get('tanggal_selesai');
        $tahunajaran->save();
        
        return redirect('sarpras/tahunajaran')->with('sukses_simpan','yes');
    }

    public function getDelete($id_tahun_ajaran)
    {
        Tahunajaran::find($id_tahun_ajaran)->delete();
        return redirect('sarpras/tahunajaran')->with('sukses_hapus','yes');
    }

    public function getEdit($id_tahun_ajaran)
    {
        $tahunajaran = Tahunajaran::find($id_tahun_ajaran);
        $tahunajarannavbar = Tahunajaran::all();
        return view('tahunajaran.edit')
        ->with('tahunajaran',$tahunajaran)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }
    public function getUpdate($id_tahun_ajaran, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_ajaran' => 'required',
            'tanggal_mulai' => 'required|date_format:Y-m-d',
            'tanggal_selesai' => 'required|date_format:Y-m-d',
        ]);
        if ($validator->fails()) {
            return redirect('sarpras/tahunajaran/edit')
                ->withErrors($validator)
                ->withInput();
        }
        $tanggal_mulai = Input::get('tanggal_mulai');
        $tanggal_selesai = Input::get('tanggal_selesai');
        if ($tanggal_mulai > $tanggal_selesai) {
            return redirect('sarpras/tahunajaran/add')
                ->withErrors('Tanggal Mulai Atau Tanggal Selesai Tidak Valid')
                ->withInput();
        }

        $tahunajaran = Tahunajaran::find($id_tahun_ajaran);
        $tahunajaran->tahun_ajaran = Input::get('tahun_ajaran');
        $tahunajaran->tanggal_mulai = Input::get('tanggal_mulai');
        $tahunajaran->tanggal_selesai = Input::get('tanggal_selesai');
        $tahunajaran->save();
        
        return redirect('sarpras/tahunajaran')->with('sukses_update','yes');
    }


    public function getLock($id_tahun_ajaran, Request $request)
    {
        
        $tahunajaran = Tahunajaran::find($id_tahun_ajaran);
        
        // $data->nama_field_di_database = Input::get('nama_field_di_form');
        $tahunajaran->aksi = "terkunci";
        
        $tahunajaran->save();
        
        return redirect('sarpras/tahunajaran')->with('sukses_kunci','yes');

    }

    public function getUse($id_tahun_ajaran, Request $request)
    {
        // if ($request->status=="aktif"){
        //     \DB::table('tahun_ajarans')->update(array('status'=>"non-aktif"));
        // }
        $aktif = DB::table('tahun_ajarans')->select('tahun_ajarans.id_tahun_ajaran')->where('tahun_ajarans.status','=','aktif')->get();
        if ($aktif->count() == 0){
            $tahunajaran = Tahunajaran::find($id_tahun_ajaran);
            $tahunajaran->status = 'aktif';
            $tahunajaran->save();
            return redirect('sarpras/tahunajaran')->with('sukses_pakai','yes');
        } else
        $id = Tahunajaran::where('status','=','aktif')->pluck('id_tahun_ajaran')[0];;
        $tahunajarannow = Tahunajaran::find($id);
        $tahunajarannow->status = 'non-aktif';
        $tahunajarannow->save();
        
        $tahunajaran = Tahunajaran::find($id_tahun_ajaran);
        $tahunajaran->status = 'aktif';
        $tahunajaran->save();
        return redirect('sarpras/tahunajaran')->with('sukses_pakai','yes');
    }

}
