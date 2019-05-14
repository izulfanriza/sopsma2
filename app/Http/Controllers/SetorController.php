<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahunajaran as Tahunajaran;
use App\Models\Transaksi as Transaksi;
use App\Models\Detailsiswa as Detailsiswa;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Codedge\Fpdf\Fpdf\Fpdf as pdf;


class SetorController extends Controller
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

    const DPI = 96;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 297;
    const A4_WIDTH = 210;
    // tweak these values (in pixels)
    const MAX_WIDTH = 800;
    const MAX_HEIGHT = 500;

    function tanggal_indo($tanggal){
        $bulan = array (
            1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktrober','November','Desember');
        $explode = explode('-',$tanggal);
        return $explode[2].' '.$bulan[(int)$explode[1]].' '.$explode[0];
    }   

    function bulan($tanggal){
        $bulan = array (
            1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktrober','November','Desember');
        $explode = explode('-',$tanggal);
        return $bulan[(int)$explode[1]];
    }

    function pixelsToMM($val) {
        return $val * self::MM_IN_INCH / self::DPI;
    }
    function resizeToFit($imgFilename) {
        list($width, $height) = getimagesize($imgFilename);
        $widthScale = self::MAX_WIDTH / $width;
        $heightScale = self::MAX_HEIGHT / $height;
        $scale = min($widthScale, $heightScale);
        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $transaksi = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.status','=','sudah-rekap')
        ->where('transaksis.status_setor','=','belum-setor')
        ->select('transaksis.*','detail_siswas.nis','siswas.nama_siswa','kelas.*','detail_siswas.*','users.nama_petugas')
        ->get();
        $tahunajarannavbar = Tahunajaran::all();
        return view('setor.index')
        ->with('transaksi',$transaksi)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }
    public function getProses()
    {   
        $dt = Carbon::now();
        $transaksi = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.status','=','sudah-rekap')
        ->where('transaksis.status_setor','=','belum-setor')
        ->select('transaksis.*','detail_siswas.nis','siswas.nama_siswa','kelas.*','detail_siswas.*','users.nama_petugas','tahun_ajarans.*')
        ->get();
        foreach ($transaksi as $key) {
            $transaksi = Transaksi::find($key->id_transaksi);
            $transaksi->status_setor = "sudah-setor";
            $transaksi->tanggal_setor = $dt->toDateString();
            $transaksi->id_petugas_setor = Auth::user()->id;
            $transaksi->save();
        }
       return redirect('tu/setor/riwayat')->with('sukses_setor','yes');
    }


    public function getRiwayat()
    {   
        $setor = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas_setor','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.status','=','sudah-rekap')
        ->where('transaksis.status_setor','=','sudah-setor')
        ->select('transaksis.id_petugas_setor','users.nama_petugas','transaksis.tanggal_setor',DB::raw('COUNT(transaksis.id_transaksi) as trk'),DB::raw('SUM(detail_siswas.nominal_sop) as jml'))
        ->groupBy('transaksis.tanggal_setor')
        ->groupBy('transaksis.id_petugas_setor')
        ->groupBy('users.nama_petugas')
        ->get();
        $tahunajarannavbar = Tahunajaran::all();
        $no = 1;
        return view('setor.rwayat')
        ->with('setor',$setor)
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('no',$no);
    }

    public function getShow($tgl_setor, $id_petugas)
    {   
        $detailsetor = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas_setor','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.status','=','sudah-rekap')
        ->where('transaksis.status_setor','=','sudah-setor')
        ->where('transaksis.tanggal_setor','=',$tgl_setor)
        ->where('transaksis.id_petugas_setor','=',$id_petugas)
        ->select('transaksis.*','detail_siswas.nis','detail_siswas.nominal_sop','kelas.*','siswas.nama_siswa','users.nama_petugas')
        ->get();
        $tahunajarannavbar = Tahunajaran::all();
        $no = 1;
        return view('setor.show')
        ->with('detailsetor',$detailsetor)
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('no',$no);
    }

    public function getCetak($tanggal_setor, $id_petugas_setor){

        $transaksi = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->join('users','transaksis.id_petugas_setor','=','users.id')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.id_petugas_setor','=',$id_petugas_setor)
        ->where('transaksis.tanggal_setor','=',$tanggal_setor)
        ->select(DB::raw('COUNT(transaksis.id_transaksi) as jml'), DB::raw('SUM(detail_siswas.nominal_sop) as uang'))
        ->get();

        $tahunaktif = DB::table('tahun_ajarans')
        ->where('tahun_ajarans.status','=','aktif')
        ->select('tahun_ajarans.tahun_ajaran')
        ->get();

        $ptgs_setor = DB::table('transaksis')
        ->join('users','transaksis.id_petugas_setor','=','users.id')
        ->where('transaksis.id_petugas_setor','=',$id_petugas_setor)
        ->select('users.nama_petugas')
        ->get();

        $pdf = new pdf();

        $pdf->AddPage('P','A4','mm');

        $urlimg = asset('/assets/images/logo_kwi.png');
        list($width, $height) = $this->resizeToFit($urlimg);
        $pdf->Image($urlimg,10,6,($width/7),($height/7));

        $pdf->SetFont('Arial','B',14);
        $pdf->Ln(2);
        $pdf->Cell(20);
        $pdf->Cell(0,0,'SMA NEGERI 2 TEGAL',0,1,'L');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(20);
        $pdf->Cell(0,8,'Jl Lumba lumba No 24, Kelurahan Tegalsari, Kecamatan Tegal Barat, Kota Tegal, Provinsi Jawa Tengah',0,1,'L');
        $pdf->Cell(20);
        $pdf->Cell(0,0,'Telp. (0283) 356816 | Kode Pos 52111 | Email: sman2_kotategal@yahoo.com',0,1,'L');

        $pdf->Setlinewidth(1);
        $pdf->Line(10,27,195,27);
        $pdf->Setlinewidth(0);
        $pdf->Line(10,28,195,28);

        $pdf->SetFont('Arial','B',16);
        $pdf->Ln(4);
        $pdf->Cell(0,20,'BUKTI SETOR SUMBANGAN OPERASIONAL PENDIDIKAN',0,1,'C');

        $pdf->Setlinewidth(0);
        $pdf->Line(10,40,195,40);
        $pdf->Ln(5);

        foreach ($transaksi as $key) {
            foreach ($ptgs_setor as $val){
                foreach ($tahunaktif as $ta) {

            $pdf->SetFont('Arial','',12);

            $pdf->Cell(6);
            $pdf->Cell(35,5,'Tanggal Setor',0,0,'L');
            $pdf->Cell(40,5,': '.$this->tanggal_indo($tanggal_setor),0,1,'L');

            $pdf->Cell(6);
            $pdf->Cell(35,5,'Petugas Setor',0,0,'L');
            $pdf->Cell(40,5,': '.$val->nama_petugas,0,1,'L');

            $pdf->Cell(6);
            $pdf->Cell(35,5,'Tahun Ajaran',0,0,'L');
            $pdf->Cell(40,5,': '.$ta->tahun_ajaran,0,1,'L');

            $pdf->Ln(1);

            $pdf->Setlinewidth(0);
            $pdf->Line(10,70,195,70);
            $pdf->Ln(7);

            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(95,5,'Jumlah Transaksi',0,0,'C');
            $pdf->Cell(95,5,'Jumlah Uang',0,1,'C');

            $pdf->Setlinewidth(0);
            $pdf->Line(10,78,195,78);
            $pdf->Ln(2);

            $pdf->Cell(95,5,$key->jml.' Transaksi',0,0,'C');
            $pdf->Cell(95,5,'Rp. '.number_format($key->uang,'0','','.').',-',0,1,'C');
            $pdf->Ln(17);

            $pdf->SetFont('Arial','',12);
            $pdf->Cell(95,5,'',0,0,'C');
            $skrng = Carbon::now();
            $pdf->Cell(95,5,'Tegal, '.$this->tanggal_indo(date('Y-m-d',strtotime($skrng))),0,1,'C');

            $pdf->SetFont('Arial','',12);
            $pdf->Cell(95,5,'',0,0,'C');
            $pdf->Cell(95,5,'Yang Menerima,',0,1,'C');
            $pdf->Ln(12);

            $pdf->SetFont('Arial','',12);
            $pdf->Cell(95,5,'',0,0,'C');
            $pdf->Cell(95,5,'Bendahara Sekolah',0,1,'C');
           
            $pdf->Output();
        }
        }
        }
    }
}
