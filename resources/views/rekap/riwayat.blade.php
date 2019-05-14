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

					<!-- Basic datatable -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Riwayat Rekap</h5>
							<div class="heading-elements">
							</div>
						</div>

						<table class="table datatable-basic">
							<thead>
								<tr>
									<th>Tanggal Rekap</th>
									<th>Jumlah Transaksi</th>
									<th>Jumlah Uang</th>
									<th>Petugas Rekap</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>@foreach ($rekap as $r)
								<tr>
									<td><?php echo tanggal_indo($r->tanggal_rekap); ?></td>
									<td><?php echo $r->trk; ?></td>
									<td>Rp. <?php echo number_format($r->jml,'0','','.'); ?>,-</td>
									<td><?php echo $r->nama_petugas; ?></td>
									<td class="text-center">
										<a href="{{ url('tu/rekap/show/'.$r->tanggal_rekap.'/'.$r->id_petugas_rekap) }}"><span class="label label-info">Lihat Detail</span></a>
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
