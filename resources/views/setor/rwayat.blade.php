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
@if (Session::has('sukses_setor'))
<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
	<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
	<span class="text-semibold">Sukses!</span> &bull; Berhasil Menyetor Transaksi. Silahkan Cetak <span class="text-semibold"> Bukti Setor!</span>
</div>
@endif

					<!-- Basic datatable -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Riwayat Setor</h5>
							<div class="heading-elements">
							</div>
						</div>

						<table class="table datatable-basic">
							<thead>
								<tr>
									<th>Tanggal Setor</th>
									<th>Jumlah Transaksi</th>
									<th>Jumlah Uang</th>
									<th>Petugas Setor</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>@foreach ($setor as $s)
								<tr>
									<td><?php echo tanggal_indo($s->tanggal_setor); ?></td>
									<td><?php echo $s->trk; ?></td>
									<td>Rp. <?php echo number_format($s->jml,'0','','.'); ?>,-</td>
									<td><?php echo $s->nama_petugas; ?></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="{{ url('tu/setor/show/'.$s->tanggal_setor.'/'.$s->id_petugas_setor) }}"><i class="icon-eye"></i> Lihat Detail</a></li>
													<li><a href="{{ url('tu/setor/cetak/'.$s->tanggal_setor.'/'.$s->id_petugas_setor) }}"><i class="icon-printer2"></i> Cetak Bukti Setor</a></li>
												</ul>
											</li>
										</ul>
									</td>

								</tr>@endforeach
							</tbody>
						</table>
					</div>
					<!-- /basic datatable -->

</div>
	<!-- /content area -->



	@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/uploader_bootstrap.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js') }}"></script>

@endsection
