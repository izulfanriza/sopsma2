<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahunajaran as Tahunajaran;
use Illuminate\Support\Facades\DB;

class SarprasController extends Controller
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
        $tahunajarannavbar = Tahunajaran::get();

        $pemasukanx = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','X')
        ->where('transaksis.status_setor','=','sudah-setor')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $kebutuhanx = DB::table('detail_siswas')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','X')
        ->where('detail_siswas.aksi','=','terkunci')
        ->select( DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $pemasukanxi = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XI')
        ->where('transaksis.status_setor','=','sudah-setor')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $kebutuhanxi = DB::table('detail_siswas')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XI')
        ->where('detail_siswas.aksi','=','terkunci')
        ->select( DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $pemasukanxii = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XII')
        ->where('transaksis.status_setor','=','sudah-setor')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $kebutuhanxii = DB::table('detail_siswas')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XII')
        ->where('detail_siswas.aksi','=','terkunci')
        ->select( DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $siswax = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','X')
        ->where('siswas.status','=','aktif')
        ->select(DB::raw('COUNT(siswas.nis) as jml'))
        ->get();

        $siswaxl = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','X')
        ->where('siswas.status','=','aktif')
        ->where('siswas.jenis_kelamin','=','L')
        ->select(DB::raw('COUNT(siswas.nis) as jml'))
        ->get();

        $siswaxp = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','X')
        ->where('siswas.status','=','aktif')
        ->where('siswas.jenis_kelamin','=','P')
        ->select(DB::raw('COUNT(siswas.nis) as jml'))
        ->get();

        $siswaxi = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XI')
        ->where('siswas.status','=','aktif')
        ->select(DB::raw('COUNT(siswas.nis) as jml'))
        ->get();

        $siswaxil = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XI')
        ->where('siswas.status','=','aktif')
        ->where('siswas.jenis_kelamin','=','L')
        ->select(DB::raw('COUNT(siswas.nis) as jml'))
        ->get();

        $siswaxip = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XI')
        ->where('siswas.status','=','aktif')
        ->where('siswas.jenis_kelamin','=','P')
        ->select(DB::raw('COUNT(siswas.nis) as jml'))
        ->get();

        $siswaxii = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XII')
        ->where('siswas.status','=','aktif')
        ->select(DB::raw('COUNT(siswas.nis) as jml'))
        ->get();

        $siswaxiil = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XII')
        ->where('siswas.status','=','aktif')
        ->where('siswas.jenis_kelamin','=','L')
        ->select(DB::raw('COUNT(siswas.nis) as jml'))
        ->get();

        $siswaxiip = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XII')
        ->where('siswas.status','=','aktif')
        ->where('siswas.jenis_kelamin','=','P')
        ->select(DB::raw('COUNT(siswas.nis) as jml'))
        ->get();

        $kelasx = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','X')
        ->where('kelas.aksi','=','terkunci')
        ->select(DB::raw('COUNT(kelas.id_kelas) as jml'))
        ->get();

        $kelasxm = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','X')
        ->where('kelas.jurusan_kelas','=','MIA')
        ->where('kelas.aksi','=','terkunci')
        ->select(DB::raw('COUNT(kelas.id_kelas) as jml'))
        ->get();

        $kelasxs = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','X')
        ->where('kelas.jurusan_kelas','=','IS')
        ->where('kelas.aksi','=','terkunci')
        ->select(DB::raw('COUNT(kelas.id_kelas) as jml'))
        ->get();

        $kelasxi = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XI')
        ->where('kelas.aksi','=','terkunci')
        ->select(DB::raw('COUNT(kelas.id_kelas) as jml'))
        ->get();

        $kelasxim = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XI')
        ->where('kelas.jurusan_kelas','=','MIA')
        ->where('kelas.aksi','=','terkunci')
        ->select(DB::raw('COUNT(kelas.id_kelas) as jml'))
        ->get();

        $kelasxis = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XI')
        ->where('kelas.jurusan_kelas','=','IS')
        ->where('kelas.aksi','=','terkunci')
        ->select(DB::raw('COUNT(kelas.id_kelas) as jml'))
        ->get();

        $kelasxii = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XII')
        ->where('kelas.aksi','=','terkunci')
        ->select(DB::raw('COUNT(kelas.id_kelas) as jml'))
        ->get();

        $kelasxiim = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XII')
        ->where('kelas.jurusan_kelas','=','MIA')
        ->where('kelas.aksi','=','terkunci')
        ->select(DB::raw('COUNT(kelas.id_kelas) as jml'))
        ->get();

        $kelasxiis = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XII')
        ->where('kelas.jurusan_kelas','=','IS')
        ->where('kelas.aksi','=','terkunci')
        ->select(DB::raw('COUNT(kelas.id_kelas) as jml'))
        ->get();

        $totalx = DB::table('detail_siswas')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('kelas.tingkat_kelas','=','X')
        ->where('tahun_ajarans.status','=','aktif')
        ->select(DB::raw('COUNT(detail_siswas.id_detail_siswa) as total'))
        ->get();

        $transaksix = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','X')
        ->where('transaksis.status_setor','=','sudah-setor')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as sudah'))
        ->get();

        $totalxi = DB::table('detail_siswas')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('kelas.tingkat_kelas','=','XI')
        ->where('tahun_ajarans.status','=','aktif')
        ->select(DB::raw('COUNT(detail_siswas.id_detail_siswa) as total'))
        ->get();

        $transaksixi = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XI')
        ->where('transaksis.status_setor','=','sudah-setor')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as sudah'))
        ->get();

        $totalxii = DB::table('detail_siswas')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('kelas.tingkat_kelas','=','XII')
        ->where('tahun_ajarans.status','=','aktif')
        ->select(DB::raw('COUNT(detail_siswas.id_detail_siswa) as total'))
        ->get();

        $transaksixii = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.tingkat_kelas','=','XII')
        ->where('transaksis.status_setor','=','sudah-setor')
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as sudah'))
        ->get();

        return view('sarpras.index',array())
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('pemasukanx',$pemasukanx)
        ->with('kebutuhanx',$kebutuhanx)
        ->with('pemasukanxi',$pemasukanxi)
        ->with('kebutuhanxi',$kebutuhanxi)
        ->with('pemasukanxii',$pemasukanxii)
        ->with('kebutuhanxii',$kebutuhanxii)
        ->with('siswax',$siswax)
        ->with('siswaxl',$siswaxl)
        ->with('siswaxp',$siswaxp)
        ->with('siswaxi',$siswaxi)
        ->with('siswaxil',$siswaxil)
        ->with('siswaxip',$siswaxip)
        ->with('siswaxii',$siswaxii)
        ->with('siswaxiil',$siswaxiil)
        ->with('siswaxiip',$siswaxiip)
        ->with('kelasx',$kelasx)
        ->with('kelasxm',$kelasxm)
        ->with('kelasxs',$kelasxs)
        ->with('kelasxi',$kelasxi)
        ->with('kelasxim',$kelasxim)
        ->with('kelasxis',$kelasxis)
        ->with('kelasxii',$kelasxii)
        ->with('kelasxiim',$kelasxiim)
        ->with('kelasxiis',$kelasxiis)
        ->with('totalx',$totalx)
        ->with('transaksix',$transaksix)
        ->with('totalxi',$totalxi)
        ->with('transaksixi',$transaksixi)
        ->with('totalxii',$totalxii)
        ->with('transaksixii',$transaksixii);
    }
}
