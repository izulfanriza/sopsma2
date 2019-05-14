<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf as pdf;
use App\Models\Transaksi as Transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KwitansiController extends Controller
{
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
		return $bulan[$tanggal];
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

    public function print($id_transaksi)
    {
    	$transaksi = DB::table('transaksis')
    	->join('detail_siswas','transaksis.id_detail_siswa','detail_siswas.id_detail_siswa')
        ->join('siswas','detail_siswas.nis','siswas.nis')
    	->join('kelas','detail_siswas.id_kelas','=','kelas.id_kelas')
    	->join('tahun_ajarans','kelas.id_tahun_ajaran','=','tahun_ajarans.id_tahun_ajaran')
    	->join('users','transaksis.id_petugas','=','users.id')
    	->where('tahun_ajarans.status','=','aktif')
        ->where('transaksis.id_transaksi','=',$id_transaksi)
        ->select('transaksis.*','siswas.*','kelas.*','detail_siswas.*','users.nama_petugas','tahun_ajarans.tahun_ajaran')
        ->get();
    	$pdf = new pdf();

	    $pdf->AddPage('L','A5','mm');

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
	    $pdf->Cell(0,20,'BUKTI PEMBAYARAN SUMBANGAN OPERASIONAL PENDIDIKAN',0,1,'C');

	    $pdf->Setlinewidth(0);
	    $pdf->Line(10,40,195,40);
	    $pdf->Ln(5);
	    
	    foreach ($transaksi as $t) {
	    	$pdf->SetFont('Arial','',12);

	    	$pdf->Cell(6);
	    	$pdf->Cell(25,5,'NIS',0,0,'L');
	    	$pdf->Cell(40,5,': '.$t->nis,0,0,'L');
	    	$pdf->Cell(35);
	    	$pdf->Cell(30,5,'Tanggal Bayar',0,0,'L');
	    	$pdf->Cell(25,5,': '.$this->tanggal_indo(date('Y-m-d',strtotime($t->tanggal_transaksi))),0,1,'L');
	    	
	    	$pdf->Cell(6);
	    	$pdf->Cell(25,5,'Nama Siswa',0,0,'L');
	    	$pdf->Cell(40,5,': '.$t->nama_siswa,0,0,'L');
	    	$pdf->Cell(35);
	    	$pdf->Cell(30,5,'Jam Bayar',0,0,'L');
	    	$pdf->Cell(25,5,': '.date('H:i',strtotime($t->tanggal_transaksi)).' WIB',0,1,'L');

	    	$pdf->Cell(6);
	    	$pdf->Cell(25,5,'Kelas',0,0,'L');
	    	$pdf->Cell(40,5,': '.$t->tingkat_kelas.' '.$t->jurusan_kelas.' '.$t->kode_kelas,0,0,'L');
	    	$pdf->Cell(35);
	    	$pdf->Cell(30,5,'Tahun Ajaran',0,0,'L');
	    	$pdf->Cell(25,5,': '.$t->tahun_ajaran,0,1,'L');
	    	$pdf->Ln(1);

	    	$pdf->Setlinewidth(0);
		    $pdf->Line(10,70,195,70);
		    $pdf->Ln(7);

		    $pdf->SetFont('Arial','B',12);
		    $pdf->Cell(95,5,'Keterangan Pembayaran',0,0,'C');
		    $pdf->Cell(95,5,'Jumlah',0,1,'C');

		    $pdf->Setlinewidth(0);
		    $pdf->Line(10,78,195,78);
		    $pdf->Ln(2);

		    $pdf->Cell(95,5,'Bulan '.$this->bulan($t->bulan),0,0,'C');
		    $pdf->Cell(95,5,'Rp.'.number_format($t->nominal_sop,'0','','.').',-',0,1,'C');
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
		    $pdf->Cell(95,5,$t->nama_petugas,0,1,'C');
	    }
	   
	    $pdf->Output();
	}

}
