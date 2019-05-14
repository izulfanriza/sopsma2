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
							@foreach ($detailsetor as $ds)
							@endforeach
							<h5 class="panel-title">Detail Setor Tanggal <h5> Tanggal : <?php echo tanggal_indo($ds->tanggal_rekap);?></h5> <h5> Petugas Setor : <?php echo $ds->nama_petugas;?></h5></h5>
							<div class="heading-elements">
								<a href="{{ url('tu/setor/riwayat') }}">
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
							<tbody>@foreach ($detailsetor as $ds)
								<tr>
									<td><?php echo $ds->nis; ?></td>
									<td><?php echo $ds->nama_siswa; ?></td>
									<td><?php echo $ds->tingkat_kelas;?> <?php echo $ds->jurusan_kelas;?> <?php echo $ds->kode_kelas;?></td>
									<td><?php echo bulan($ds->bulan); ?></td>
									<td>Rp. <?php echo number_format($ds->nominal_sop,'0','','.'); ?>,-</td>
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
