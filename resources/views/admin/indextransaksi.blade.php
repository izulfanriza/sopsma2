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
					@if (Session::has('sukses_hapus'))
					<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
						<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
						<span class="text-semibold">Sukses!</span> &bull; Berhasil Menghapus Transaksi.
					</div>
					@endif

					<!-- Tabel kelas -->
	<div class="panel panel-flat" style="position: static;">
		<div class="panel-heading">
			<h5 class="panel-title">Riwayat Transaksi</h5>
			<div class="heading-elements">
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>

		<div class="table-responsive" style="display: block;">
			<table class="table datatable-basic table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>NIS</th>
						<th>Bulan</th>
						<th>Nominal SOP</th>
						<th>Tanggal Transaksi</th>
						<th>Petugas Transaksi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($transaksi as $t)
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $t->nis ;?></td>
						<td><?php echo bulan($t->bulan) ;?></td>
						<td>Rp. <?php echo number_format($t->nominal_sop,'0','','.') ;?>,-</td>
						<td><?php echo tanggal_indo(date('Y-m-d',strtotime($t->tanggal_transaksi))) ;?></td>
						<td><?php echo $t->nama_petugas ;?></td>
						@if($t->status_setor=='sudah-setor')
						<td>
							<span class="label label-info">Transaksi Lengkap</span>
						</td>
						@elseif($t->status_setor=='belum-setor')
						<td>
							<a href="{{ url('admin/transaksi/delete/'.$t->id_transaksi) }}" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Transaksi Ini?')"><span class="label label-warning"><i class="icon-trash"></i>&nbsp;Hapus Transaksi</a>
						</td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- /tabel kelas -->

				</div>
				<!-- /content area -->
				

			
@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_select2.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection