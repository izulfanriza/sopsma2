<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\Tahunajaran as Tahunajaran;
use App\Models\Detailsiswa as Detailsiswa;
use App\Models\Transaksi as Transaksi;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Mail;

class TransaksiController extends Controller
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
        $detailsiswa = Detailsiswa::where('aksi','=','terkunci')->get();
        $nis = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','=','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('siswas.status','=','aktif')
        ->where('detail_siswas.aksi','=','terkunci')
        ->where('kelas.aksi','=','terkunci')
        ->where('tahun_ajarans.status','=','aktif')
        ->select('siswas.*')
        ->orderBy('siswas.nis','asc')
        ->get();
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
        return view('transaksi.index')
        ->with('detailsiswa',$detailsiswa)
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('nis',$nis)
        ->with('transaksi',$transaksi);
    }

    public function getProses(Request $request)
    {
        $tahunajarannavbar = Tahunajaran::all();
        $date = DB::table('tahun_ajarans')->select(DB::raw('MONTH(tanggal_mulai) as bulan'))->where('status','=','aktif')->get();
        $nis = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','=','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('siswas.nis','=',$request->nis)->get();
        $transaksi = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('siswas.nis','=',$request->nis)
        ->get();
        return view('transaksi.proses')
        ->with('nis',$nis)
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('transaksi',$transaksi)
        ->with('date',$date);
    }


    public function getProsess($paramid)
    {
        $tahunajarannavbar = Tahunajaran::all();
        $date = DB::table('tahun_ajarans')->select(DB::raw('MONTH(tanggal_mulai) as bulan'))->where('status','=','aktif')->get();
        $nis = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','=','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('detail_siswas.id_detail_siswa','=',$paramid)->get();
        $transaksi = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('detail_siswas.id_detail_siswa','=',$paramid)
        ->get();
        return view('transaksi.proses')
        ->with('nis',$nis)
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('transaksi',$transaksi)
        ->with('date',$date);
    }

    function bulan($tanggal){
        $bulan = array (
            1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktrober','November','Desember');
        return $bulan[$tanggal];
    }
    function tanggal_indo($tanggal){
        $bulan = array (
            1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktrober','November','Desember');
        $explode = explode('-',$tanggal);
        return $explode[2].' '.$bulan[(int)$explode[1]].' '.$explode[0];
    }   

    public function getBayar($id_detail_siswa, $bulan)
    {
        $transaksi = new Transaksi;
        $transaksi->id_detail_siswa = $id_detail_siswa;
        $transaksi->bulan = $bulan;
        $transaksi->id_petugas = Auth::user()->id;
        $transaksi->save();
        
        return redirect('tu/transaksi/prosess/'.$id_detail_siswa)->with('sukses_bayar','yes');
    }
    public function sendEmail($id_detail_siswa, $id_transaksi)
    {
        $pesan = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.id_transaksi','=',$id_transaksi)
        ->select('siswas.nama_siswa','siswas.no_hp_wali','detail_siswas.nominal_sop','transaksis.tanggal_transaksi','transaksis.bulan')
        ->get();

        foreach ($pesan as $val) {}
           try{
                Mail::raw('Terima kasih telah melakukan pembayaran Sumbangan Operasional Pendidikan Saudara/i '.$val->nama_siswa.' pembayaran SOP bulan '.$this->bulan($val->bulan).' sebesar Rp.'.number_format($val->nominal_sop,'0','','.').',- pada tanggal '.$this->tanggal_indo(date('Y-m-d',strtotime($val->tanggal_transaksi))), function ($mail) use ($val)
                {
                    $mail->subject('Bukti Pembayaran Sumbangan Operasional Pendidikan SMA N 2 Tegal');
                    $mail->from('sman2_kotategal@yahoo.com', 'Tata Usaha SMA N 2 Tegal');
                    $mail->to($val->no_hp_wali);
                });
                return redirect('tu/transaksi/prosess/'.$id_detail_siswa)->with('sukses_kirim','yes');
            }
            catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
            }
    }

    public function getShow($id_transaksi){
        $tahunajarannavbar = Tahunajaran::all();

        $trk = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.id_transaksi','=',$id_transaksi)
        ->select('transaksis.*','detail_siswas.nis','detail_siswas.nominal_sop','kelas.*','siswas.nama_siswa','users.nama_petugas')
        ->get();

        $trkrekap = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas_rekap','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.id_transaksi','=',$id_transaksi)
        ->select('transaksis.*','detail_siswas.nis','detail_siswas.nominal_sop','kelas.*','siswas.nama_siswa','users.nama_petugas')
        ->get();

        $trksetor = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas_setor','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.id_transaksi','=',$id_transaksi)
        ->select('transaksis.*','detail_siswas.nis','detail_siswas.nominal_sop','kelas.*','siswas.nama_siswa','users.nama_petugas')
        ->get();

        return view ('transaksi.show',array())
         ->with('tahunajarannavbar',$tahunajarannavbar)
         ->with('trk',$trk)
         ->with('trkrekap',$trkrekap)
         ->with('trksetor',$trksetor);
    }
}
