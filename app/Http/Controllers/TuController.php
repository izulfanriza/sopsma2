<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahunajaran as Tahunajaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TuController extends Controller
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
        $now = Carbon::now();
        $dn = $now->toDateString();
        $mn = $now->month;

        $trknow = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where(DB::raw('DATE(transaksis.tanggal_transaksi)'),'=',$dn)
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $trkmonth = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where(DB::raw('MONTH(transaksis.tanggal_transaksi)'),'=',$mn)
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $trkall = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $rekapmonth = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where(DB::raw('MONTH(transaksis.tanggal_transaksi)'),'=',$mn)
        ->where('transaksis.status','=','sudah-rekap')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $rekapall = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.status','=','sudah-rekap')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $setormonth = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where(DB::raw('MONTH(transaksis.tanggal_transaksi)'),'=',$mn)
        ->where('transaksis.status_setor','=','sudah-setor')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $setorall = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.status_setor','=','sudah-setor')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        return view('tu.index',array())
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('trknow',$trknow)
        ->with('trkmonth',$trkmonth)
        ->with('trkall',$trkall)
        ->with('rekapmonth',$rekapmonth)
        ->with('rekapall',$rekapall)
        ->with('setormonth',$setormonth)
        ->with('setorall',$setorall)->with('now',$now);
    }
}
