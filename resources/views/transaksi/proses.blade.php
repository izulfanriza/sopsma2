@extends('layouts.index')

@section('content')

<?php
	function bulan($month){
		$bulan = array (
			1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktrober','November','Desember');
		return $bulan[$month];
	}
	function tanggal_indo($tanggal){
		$bulan = array (
			1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktrober','November','Desember');
		$explode = explode('-',$tanggal);
		return $explode[2].' '.$bulan[(int)$explode[1]].' '.$explode[0];
	}	
?>

				<!-- Content area -->
				<div class="content">
				@if (Session::has('sukses_bayar'))
				<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
					<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Sukses!</span> &bull; Berhasil Membayar Transaksi Baru. Silahkan Cetak Kwitansi Untuk <span class="text-semibold">Bukti Pembayaran.</span>
				</div>
				@endif
				@if (Session::has('sukses_kirim'))
				<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
					<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengirim Email Pemberitahuan.
				</div>
				@endif
					<!-- Form tambah Detail Siswa -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Detail Siswa</h5>
							<div class="heading-elements">
								<a href="{{ url('tu/transaksi') }}">
									<button type="button" class="btn btn-warning btn-sm legitRipple"><i class="icon-cross3 position-left"></i>Batal</button>
								</a>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a>
						</div>

						<div class="panel-body">
							@foreach ($nis as $n)
							<form class="form-horizontal" action="{{ url('tu/transaksi/save') }}">
								<fieldset class="content-group">
									<legend class="text-bold"></legend>

									<div class="form-group">
										<label class="control-label col-lg-2">NIS</label>
										<div class="col-lg-10">
											<input class="form-control" readonly="readonly" value="{{ $n->nis}}" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Nama Siswa</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="{{ $n->nama_siswa}}" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Kelas</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value="{{ $n->tingkat_kelas}} {{ $n->jurusan_kelas}} {{ $n->kode_kelas}}" type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-2">Nominal SOP</label>
										<div class="col-md-10">
											<input class="form-control" readonly="readonly" value=" Rp. {{ number_format($n->nominal_sop,'0','','.') }},-" type="text">
										</div>
									</div>



								<!-- <div class="form-group">
									<div class="text-right">
										{{ csrf_field() }}
										<button type="submit" class="btn btn-success btn-sm legitRipple">Bayar <i class="icon-arrow-right14 position-right"></i></button>
									</div>
								</div> -->
							</form>
							
						</div>
					</div>
					<!-- /form tambah Detail Siswa -->
					@foreach ($date as $d)
					@endforeach
					<div class="panel panel-flat" style="position: static;">
						<div class="panel-heading">
							<h5 class="panel-title">Riawayat Pembayaran</h5>
								<div class="heading-elements">
		                		</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a>
						</div>
						<div class="table-responsive" style="display: block;">
						
							<table class="table table-bordered table-striped">
								<thead>
									
									<tr>
									<?php 
									$bulan = $d->bulan; 
									for ($i=1; $i<13; $i++){
										echo '<th>'. bulan($bulan) .'</th>';
										if ($bulan == 12){
											$bulan = 1;
										} else {
											$bulan+=1;
										}
									}
									?>
									</tr>
									
								</thead>
								<tbody>
									<tr>
										<?php
										$bulan = $d->bulan; 
										$disable = false;
										for ($i=1; $i<13; $i++){
											$lunas = false;
											foreach ($transaksi as $row){
												if ($row->bulan == $bulan){
													$lunas = true;
													$tanggal = $row->tanggal_transaksi;
													$id_transaksi = $row->id_transaksi;
												}
											}
											if ($lunas == false){
												if ($disable == true){
													echo '<td><span class="label label-danger">BAYAR</span></td>';
												} else{
													echo '<td><a href="bayar/'.$n->id_detail_siswa.'/'.$bulan.'" onclick="return confirm(`Apakah Anda Yakin Akan Membayar SOP Bulan ini?`);"><span class="label label-danger">BAYAR</span></a></td>';
														$disable = true;
												}
											} else{
												echo '<td><span class="label label-info">LUNAS '.tanggal_indo(date('Y-m-d',strtotime($tanggal))).'</span>
												<a href="cetak/'.$id_transaksi.'"><span class="label label-success" style="margin-top: 5px;">Cetak Kwitansi</span></a></td>';
												$disable = false;
											}
											
											if ($bulan == 12){
												$bulan = 1;
											} else {
												$bulan+=1;
											}
										}
										?>
									</tr>
								</tbody>
							</table>
						
						</div>
					</div>
				</div>
				@endforeach
				<!-- /content area -->
				<!-- ==UNTUK MENGAKTIFKAN FITUR EMAIL NOTIFICATION== -->
				<!-- Setelah mengaktifkan 2-step verification -->
				<!-- Masukan code dibawah ini pada posisi setelah tutup tag => Cetak Kwitansi</span></a> -->
				<!-- <a href="email/'.$n->id_detail_siswa.'/'.$id_transaksi.'"><span class="label label-primary" style="margin-top: 5px;">Kirim Pemberitahuan</span></a> -->
			
@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection