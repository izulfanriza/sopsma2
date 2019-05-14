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
	
	@if (Session::has('sukses_unlock'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Membuka Kunci. Data Tahun Ajaran Sekarang Bisa <span class="text-semibold">Diubah.</span>
	</div>
	@endif

	<!-- Tabel tahun ajaran -->
	<div class="panel panel-flat" style="position: static;">
		<div class="panel-heading">
			<h5 class="panel-title">Daftar Tahun Ajaran</h5>
			<div class="heading-elements">
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>
		<div class="table-responsive" style="display: block;">
			<table class="table datatable-basic table-bordered table-striped table-hover">

				<thead>
					<tr>
						<th>No</th>
						<th>Tahun Ajaran</th>
						<th>Tanggal Mulai</th>
						<th>Tanggal Selesai</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tahunajaran as $row)
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->tahun_ajaran;?></td>
						<td><?php echo tanggal_indo($row->tanggal_mulai);?></td>
						<td><?php echo tanggal_indo($row->tanggal_selesai);?></td>
						<td><?php if($row->status == 'aktif') echo "Aktif"; else echo "Tidak Aktif" ;?></td>
						@if($row->aksi=='tidak-terkunci')
						<td>
							<span class="label label-info">Tidak Terkunci</span>
						</td>
						@elseif($row->aksi=='terkunci')
						<td>
							<a href="{{ url('admin/tahunajaran/unlock/'.$row->id_tahun_ajaran) }}" onclick="return confirm('Apakah Anda Yakin Akan Membuka Kunci Kelas Ini?')"><span class="label label-warning"><i class="icon-unlocked"></i>&nbsp;Buka Kunci</a>
						</td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- /tabel tahun ajaran -->

</div>
<!-- /content area -->

@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js') }}"></script>

@endsection