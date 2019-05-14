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
							@foreach ($detailrekap as $dr)
							@endforeach
							<h5 class="panel-title">Detail Rekap Tanggal <h5> Tanggal : <?php echo tanggal_indo($dr->tanggal_rekap);?></h5> <h5> Petugas Rekap : <?php echo $dr->nama_petugas;?></h5></h5>
							<div class="heading-elements">
								<a href="{{ url('tu/rekap/riwayat') }}">
									<button type="button" class="btn btn-default btn-sm legitRipple"><i class="icon-arrow-left52 position-left"></i>Kembali</button>
								</a>
							</div>
						</div>

						<table class="table datatable-basic table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>NIS</th>
									<th>Nama Siswa</th>
									<th>Kelas</th>
									<th>Pembayaran Bulan</th>
									<th>Nominal SOP</th>
								</tr>
							</thead>
							<tbody>@foreach ($detailrekap as $dr)
								<tr>
									<td><?php echo $dr->nis; ?></td>
									<td><?php echo $dr->nama_siswa; ?></td>
									<td><?php echo $dr->tingkat_kelas;?> <?php echo $dr->jurusan_kelas;?> <?php echo $dr->kode_kelas;?></td>
									<td><?php echo bulan($dr->bulan); ?></td>
									<td>Rp. <?php echo number_format($dr->nominal_sop,'0','','.'); ?>,-</td>
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
