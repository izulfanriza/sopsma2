<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahunajaran as Tahunajaran;
use App\Models\Transaksi as Transaksi;
use App\Models\Detailsiswa as Detailsiswa;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class RekapController extends Controller
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
        $transaksi = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.tanggal_transaksi','=','2018-05-08 17:04:48')
        ->select('transaksis.*','detail_siswas.nis','siswas.nama_siswa','kelas.*','detail_siswas.*','users.nama_petugas')
        ->get();
        return view('rekap.index')
        ->with('transaksi',$transaksi)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }
    public function search(Request $request){
        DB::enableQueryLog();
        $tanggal = $request->input('tgl');
        $transaksi = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where(DB::raw('DATE(transaksis.tanggal_transaksi)'),'=',$tanggal)
        ->select('transaksis.*','detail_siswas.nis','siswas.nama_siswa','kelas.*','detail_siswas.*','users.nama_petugas')
        ->get();
        return json_encode($transaksi);
    }

    public function update($id_transaksi){
        $dt = Carbon::now();
        $transaksi = Transaksi::find($id_transaksi);
        $transaksi->status = "sudah-rekap";
        $transaksi->tanggal_rekap = $dt->toDateString();
        $transaksi->id_petugas_rekap = Auth::user()->id;
        
        $transaksi->save();
        return json_encode($transaksi);
    }

    public function getRiwayat(){
        $rekap = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas_rekap','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.status','=','sudah-rekap')
        ->select('transaksis.id_petugas_rekap','users.nama_petugas','transaksis.tanggal_rekap',DB::raw('COUNT(transaksis.id_transaksi) as trk'),DB::raw('SUM(detail_siswas.nominal_sop) as jml'))
        ->groupBy('transaksis.tanggal_rekap')
        ->groupBy('transaksis.id_petugas_rekap')
        ->groupBy('users.nama_petugas')
        ->get();
        $tahunajarannavbar = Tahunajaran::all();
        return view('rekap.riwayat')
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('rekap',$rekap);
    }

    public function getShow($tgl_rekap, $id_petugas){
        $detailrekap = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas_rekap','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.status','=','sudah-rekap')
        ->where('transaksis.tanggal_rekap','=',$tgl_rekap)
        ->where('transaksis.id_petugas_rekap','=',$id_petugas)
        ->select('transaksis.*','detail_siswas.nis','detail_siswas.nominal_sop','kelas.*','siswas.nama_siswa','users.nama_petugas')
        ->get();
        $tahunajarannavbar = Tahunajaran::all();
        return view('rekap.show')
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('detailrekap',$detailrekap);
    }
}
