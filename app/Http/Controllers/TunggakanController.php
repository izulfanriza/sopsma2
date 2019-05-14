<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahunajaran as Tahunajaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf as pdf;

class TunggakanController extends Controller
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

    const DPI = 96;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 297;
    const A4_WIDTH = 210;
    // tweak these values (in pixels)
    const MAX_WIDTH = 800;
    const MAX_HEIGHT = 500;

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
    function bulan($tanggal){
        $bulan = array (
            1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktrober','November','Desember');
        $explode = explode('-',$tanggal);
        return $bulan[(int)$explode[1]];
    }
    function bln($month){
        $bulan = array (
            1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktrober','November','Desember');
        return $bulan[$month];
    }

    public function index()
    {
        $tahunajarannavbar = Tahunajaran::all();
        $kelas = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('kelas.aksi','=','terkunci')
        ->where('tahun_ajarans.status','=','aktif')
        ->select('kelas.*')
        ->get();
        $tunggakan = DB::table('kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('kelas.aksi','=','terkunci')
        ->where('tahun_ajarans.status','=','aktif')
        ->select('kelas.*')
        ->get();
        return view('tunggakan.index',array())
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('kelas',$kelas)
        ->with('tunggakan',$tunggakan);
    }
    public function search(Request $request){
        $bulan = Carbon::now()->month;
        DB::enableQueryLog();
        $kelas = $request->input('kelas');
        $tunggakan = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('siswas.status','=','aktif')
        ->where('detail_siswas.aksi','=','terkunci')
        ->where('kelas.id_kelas','=',$kelas)
        ->whereNotIn('detail_siswas.id_detail_siswa', function($q) use ($kelas, $bulan){
            $q->select(DB::raw('transaksis.id_detail_siswa FROM transaksis INNER JOIN detail_siswas ON transaksis.id_detail_siswa = detail_siswas.id_detail_siswa INNER JOIN kelas on detail_siswas.id_kelas = kelas.id_kelas INNER JOIN tahun_ajarans ON kelas.id_tahun_ajaran = tahun_ajarans.id_tahun_ajaran WHERE transaksis.bulan = '.$bulan.' AND tahun_ajarans.status = "aktif" AND transaksis.status_setor ="sudah-setor" AND kelas.id_kelas = '.$kelas));
        })->select('siswas.*','kelas.*','detail_siswas.id_detail_siswa')->get();
        return json_encode($tunggakan);
    }

    public function showDetail($id_detail_siswa){
        $tahunajarannavbar = Tahunajaran::all();
        $bulan = Carbon::now()->month;
        $tunggakan = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('detail_siswas.id_detail_siswa','=',$id_detail_siswa)
        ->where('transaksis.status_setor','=','sudah-setor')
        ->select('transaksis.*','siswas.nama_siswa','siswas.nis','kelas.*','detail_siswas.nominal_sop')
        ->get();
        $transaksi = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('detail_siswas.id_detail_siswa','=',$id_detail_siswa)
        ->where('transaksis.status_setor','=','sudah-setor')
        ->get();
        $date = DB::table('tahun_ajarans')->select(DB::raw('MONTH(tanggal_mulai) as bulan'))->where('status','=','aktif')->get();
        $no = 1;
        return view('tunggakan.detail',array())
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('tunggakan',$tunggakan)
        ->with('bulan',$bulan)
        ->with('no',$no)
        ->with('transaksi',$transaksi)
        ->with('date',$date);
    }

    public function cetak(Request $request){
        $tunggakan = DB::table('transaksis')
        ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('kelas.id_kelas','=',$request->kelas)
        ->where('transaksis.status_setor','=','sudah-setor')
        ->get();
        $datemonth = DB::table('tahun_ajarans')->select(DB::raw('MONTH(tanggal_mulai) as bulan'))->where('status','=','aktif')->get();
        $bulan = Carbon::now()->month;
        foreach ($datemonth as $dm) {
            if ($dm->bulan > $bulan) {
                $selisihbln = (13-$dm->bulan)+$bulan;
            } else{
                $selisihbln = $bulan-$dm->bulan+1;
            }
        }
        
        $no = 1;
        $kelas = $request->kelas;
        $siswa = DB::table('siswas')
        ->join('detail_siswas','siswas.nis','detail_siswas.nis')
        ->join('kelas','detail_siswas.id_kelas','kelas.id_kelas')
        ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
        ->where('tahun_ajarans.status','=','aktif')
        ->where('siswas.status','=','aktif')
        ->where('kelas.id_kelas','=',$request->kelas)
        ->where('detail_siswas.aksi','=','terkunci')
        ->whereNotIn('detail_siswas.id_detail_siswa', function($q) use ($kelas, $bulan){
            $q->select(DB::raw('transaksis.id_detail_siswa FROM transaksis INNER JOIN detail_siswas ON transaksis.id_detail_siswa = detail_siswas.id_detail_siswa INNER JOIN kelas on detail_siswas.id_kelas = kelas.id_kelas INNER JOIN tahun_ajarans ON kelas.id_tahun_ajaran = tahun_ajarans.id_tahun_ajaran WHERE transaksis.bulan = '.$bulan.' AND tahun_ajarans.status = "aktif" AND transaksis.status_setor ="sudah-setor" AND detail_siswas.aksi = "terkunci" AND kelas.id_kelas = '.$kelas));
        })->select('siswas.*','kelas.*','detail_siswas.id_detail_siswa')->get();
        

        foreach ($tunggakan as $tgk) {
            $pdf = new pdf();

            $pdf->AddPage('L','A4','mm');

            $urlimg = 'assets/images/logo_kwi.png';
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
            $pdf->Line(10,27,280,27);
            $pdf->Setlinewidth(0);
            $pdf->Line(10,28,280,28);

            $pdf->SetFont('Arial','B',16);
            $pdf->Ln(4);
            $pdf->Cell(0,20,'Tunggakan SOP Kelas '.$tgk->tingkat_kelas.' '.$tgk->jurusan_kelas.' '.$tgk->kode_kelas,0,1,'C');

            $pdf->Setlinewidth(0);
            $pdf->Line(10,40,280,40);
            $pdf->Ln(5);
        
            $pdf->SetFont('Arial','',12);

            $pdf->Cell(6);
            $pdf->Cell(60,8,'Nama Siswa',1,0,'C');
            $pdf->Cell(200,8,'Tunggakan Bulan',1,1,'C');

            foreach ($siswa as $sis) {
                $pdf->Cell(6);
                $pdf->Cell(60,8,$sis->nama_siswa,1,0,'L');
                
            
                $date  = DB::table('tahun_ajarans')->select(DB::raw('MONTH(tanggal_mulai) as bulan'))->where('status','=','aktif')->get();
                foreach ($date as $d) {
                    $bulan = $d->bulan;
                }
                

                $transaksi = DB::table('transaksis')
                ->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
                ->join('siswas','detail_siswas.nis','siswas.nis')
                ->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
                ->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
                ->where('tahun_ajarans.status','=','aktif')
                ->where('detail_siswas.id_detail_siswa','=',$sis->id_detail_siswa)
                ->where('transaksis.status_setor','=','sudah-setor')
                ->get();

                $namabulan = '';
                for ($i=1; $i<=$selisihbln; $i++){
                $lunas = false;
                
                foreach ($transaksi as $row){
                    if ($row->bulan == $bulan){
                        $lunas = true;
                    }
                }

                if ($lunas == false){           
                    $namabulan .= $this->bln($bulan).', ';
                }
                
                if ($bulan == 12){
                    $bulan = 1;
                } else {
                    $bulan+=1;
                }

                }
                $pdf->Cell(200,8,$namabulan,1,1,'L');
            }
        }
            
        $pdf->Ln(1);

        $pdf->Output();        
    }

}
