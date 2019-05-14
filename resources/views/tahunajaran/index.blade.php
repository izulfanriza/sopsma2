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
	
	@if (Session::has('sukses_simpan'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Membuat Tahun Ajaran Baru. Kunci Tahun Ajaran Agar Dapat <span class="text-semibold">Digunakan.</span>
	</div>
	@endif

	@if (Session::has('sukses_update'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengubah Data Tahun Ajaran.
	</div>
	@endif

	@if (Session::has('sukses_hapus'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Menghapus Tahun Ajaran.
	</div>
	@endif

	@if (Session::has('sukses_kunci'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengunci Data Tahun Ajaran. Sekarang Tahun Ajaran ini Dapat <span class="text-semibold">Digunakan.</span>
	</div>
	@endif

	@if (Session::has('sukses_pakai'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengaktifkan Tahun Ajaran Baru. Sekarang Dapat Menambah Data Pada <span class="text-semibold">Tahun Ajaran Ini.</span>
	</div>
	@endif

	<!-- Tabel tahun ajaran -->
	<div class="panel panel-flat" style="position: static;">
		<div class="panel-heading">
			<h5 class="panel-title">Daftar Tahun Ajaran</h5>
			<div class="heading-elements">
				<a href="{{ url('sarpras/tahunajaran/add') }}">
					<button type="button" class="btn btn-primary btn-sm legitRipple"><i class="icon-plus3 position-left"></i>Tambah Tahun Ajaran</button>
				</a>
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>
		<div class="table-responsive" style="display: block;">
			<table class="table datatable-basic table-bordered table-striped table-hover">

				<thead>
					<tr>
						<th>No</th>
						<th>Nama Tahun Ajaran</th>
						<th>Tanggal Mulai</th>
						<th>Tanggal Selesai</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tahunajaran as $row)
					<tr>
						<td><?php echo $no++;?>
						<td><?php echo $row->tahun_ajaran;?></td>
						<td><?php echo tanggal_indo($row->tanggal_mulai);?></td>
						<td><?php echo tanggal_indo($row->tanggal_selesai);?></td>
						<td><?php if($row->status == 'aktif') echo "Aktif"; else echo "Tidak Aktif" ;?></td>
						@if($row->aksi=='tidak-terkunci')
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="{{ url('sarpras/tahunajaran/edit/'.$row->id_tahun_ajaran) }}"><i class="icon-pencil"></i> Edit Tahun Ajaran</a></li>
										<li><a href="{{ url('sarpras/tahunajaran/delete/'.$row->id_tahun_ajaran) }}" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Tahun Ajaran Ini?');"><i class="icon-trash"></i> Hapus Tahun Ajaran</a></li>
										<li><a href="{{ url('sarpras/tahunajaran/lock/'.$row->id_tahun_ajaran) }}" onclick="return confirm('Setelah Dikunci Data Tidak Bisa Diubah. Apakah Anda Yakin Akan Mengunci Tahun Ajaran Ini?');"><i class="icon-lock"></i> Kunci Tahun Ajaran</a></li>
									</ul>
								</li>
							</ul>
						</td>
						@elseif($row->aksi=='terkunci')
						@if($row->status=='non-aktif')
						<td>
							<a href="{{ url('sarpras/tahunajaran/use/'.$row->id_tahun_ajaran) }}" onclick="return confirm('Yakin Akan Mengaktifkan Tahun Ajaran Ini? Detail Data Bergantung Pada Tahun Ajaran Masing-Masing.');">
								<span class="label label-primary">Aktifkan Tahun Ajaran</span>
							</a>
						</td>
						@elseif($row->status=='aktif')
						<td>
							<span class="label label-success">Tahun Ajaran Aktif</span>
						</td>
						@endif
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