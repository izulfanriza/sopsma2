<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Tahunajaran as Tahunajaran;
use App\Models\Users as Users;
use App\Models\Detailsiswa as Detailsiswa;
use App\Models\Transaksi as Transaksi;
use App\Models\Kelas as Kelas;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
        $tahunajarannavbar = Tahunajaran::all();

        $sarpras = DB::table('users')
        ->where('users.role','=','sarpras')
        ->select(DB::raw('COUNT(users.id) as jml'))
        ->get();

        $tu = DB::table('users')
        ->where('users.role','=','tu')
        ->select(DB::raw('COUNT(users.id) as jml'))
        ->get();

        $detailsiswa = DB::table('detail_siswas')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->select(DB::raw('COUNT(detail_siswas.id_detail_siswa) as jml'))
        ->get();

        $detailsiswaterkunci = DB::table('detail_siswas')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('detail_siswas.aksi','=','terkunci')
        ->select(DB::raw('COUNT(detail_siswas.id_detail_siswa) as jml'))
        ->get();

        $kelas = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->select(DB::raw('COUNT(kelas.id_kelas) as jml'))
        ->get();

        $kelasterkunci = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.aksi','=','terkunci')
        ->select(DB::raw('COUNT(kelas.id_kelas) as jml'))
        ->get();

        $tahunajaran = DB::table('tahun_ajarans')
        ->select(DB::raw('COUNT(tahun_ajarans.id_tahun_ajaran) as jml'))
        ->get();

        $tahunajaranterkunci = DB::table('tahun_ajarans')
        ->where('tahun_ajarans.aksi','=','terkunci')
        ->select(DB::raw('COUNT(tahun_ajarans.id_tahun_ajaran) as jml'))
        ->get();

        $trkall = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        return view('admin.index',array())
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('sarpras',$sarpras)
        ->with('tu',$tu)
        ->with('detailsiswa',$detailsiswa)
        ->with('detailsiswaterkunci',$detailsiswaterkunci)
        ->with('kelas',$kelas)
        ->with('kelasterkunci',$kelasterkunci)
        ->with('tahunajaran',$tahunajaran)
        ->with('tahunajaranterkunci',$tahunajaranterkunci)
        ->with('trkall',$trkall);
    }


    public function getUsers()
    {
        $users = DB::table('users')
        ->where('role','=','sarpras')
        ->orWhere('role','=','tu')
        ->select('users.*')
        ->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('admin.users',array())
        ->with('users',$users)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function getAdd()
    {
        $tahunajarannavbar = Tahunajaran::all();
        return view('admin.add',array())->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function getSave(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect('admin/users/add')
                ->withErrors($validator)
                ->withInput();
        }
        
        $users = new Users;
        
        // $data->nama_field_di_database = Input::get('nama_field_di_form');
        $users->nama_petugas = Input::get('nama_petugas');
        $users->email = Input::get('email');
        $users->password = bcrypt(Input::get('password'));
        $users->role = Input::get('role');
        
        $users->save();
        
        return redirect('admin/users')->with('sukses_simpan','yes');

    }


    public function getDelete($id)
    {
        Users::find($id)->delete();
        return redirect('admin/users')->with('sukses_hapus','yes');
    }

    public function getShow($id)
    {
        $users = Users::find($id);
        $tahunajarannavbar = Tahunajaran::all();
        return view('admin.show',array())
        ->with('users',$users)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }  



    public function getResetPassword($id)
    {
        $users = Users::find($id);
        $tahunajarannavbar = Tahunajaran::all();
        return view('admin.resetpassword')
        ->with('users',$users)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }



    public function getUpdatePassword($id, Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        if ($validator->fails()) {
            return redirect('admin/users')
                ->withErrors($validator)
                ->withInput();
        }
        
        $users = Users::find($id);
        
        // $data->nama_field_di_database = Input::get('nama_field_di_form');
        $users->password = bcrypt(Input::get('password'));
        
        $users->save();
        
        return redirect('admin/users/show/'.$users->id)->with('sukses_resetpassword','yes');

    }


    public function getEdit($id)
    {
        $users = Users::find($id);
        $tahunajarannavbar = Tahunajaran::all();
        return view('admin.edit')
        ->with('users',$users)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function getUpdate($id, Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required',
        ]);

        $users = Users::find($id);

        if ($validator->fails()) {
            return redirect('admin/users/edit/'.$users->id)
                ->withErrors($validator)
                ->withInput();
        }
        
        // $data->nama_field_di_database = Input::get('nama_field_di_form');
        $users->nama_petugas = Input::get('nama_petugas');
        $users->email = Input::get('email');
        $users->role = Input::get('role');
        
        $users->save();
        
        return redirect('admin/users/show/'.$users->id)->with('sukses_update','yes');

    }

    public function getKelas(){
        $kelas = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->select('kelas.*','tahun_ajarans.tahun_ajaran')
        ->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('admin.indexkelas',array())
        ->with('kelas',$kelas)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }

    public function unlockKelas($id_kelas){
        $kelas = Kelas::find($id_kelas);

        $kelas->aksi = 'tidak-terkunci';

        $kelas->save();

        return back()->with('sukses_unlock','yes');
    }

    public function getTahunajaran(){
        $tahunajaran = DB::table('tahun_ajarans')
        ->select('tahun_ajarans.*')
        ->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('admin.indextahunajaran',array())
        ->with('tahunajaran',$tahunajaran)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }

    public function unlockTahunajaran($id_tahun_ajaran){
        $tahunajaran = Tahunajaran::find($id_tahun_ajaran);

        $tahunajaran->aksi = 'tidak-terkunci';

        $tahunajaran->save();

        return back()->with('sukses_unlock','yes');
    }

    public function getDetailsiswa(){
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
        return view('admin.indexdetailsiswa',array())
        ->with('detailsiswa',$detailsiswa)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }

    public function unlockDetailsiswa($id_detail_siswa){
        $detailsiswa = Detailsiswa::find($id_detail_siswa);

        $detailsiswa->aksi = 'tidak-terkunci';

        $detailsiswa->save();

        return back()->with('sukses_unlock','yes');
    }


    public function getTransaksi()
    {
        $tahunajarannavbar = Tahunajaran::all();
        $detailsiswa = Detailsiswa::where('aksi','=','terkunci')->get();
        $transaksi = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->select('transaksis.*','detail_siswas.nis','detail_siswas.nominal_sop','users.nama_petugas')
        ->orderBy('transaksis.tanggal_transaksi','desc')
        ->get();
        $no = 1;
        return view('admin.indextransaksi')
        ->with('detailsiswa',$detailsiswa)
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('transaksi',$transaksi)
        ->with('no',$no);
    }

    public function deleteTransaksi($id_transaksi)
    {
        Transaksi::find($id_transaksi)->delete();
        return back()->with('sukses_hapus','yes');
    }
}
