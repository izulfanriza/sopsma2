@extends('layouts.index')

@section('content')

<!-- Content area -->
<div class="content">
	
	@if (Session::has('sukses_simpan'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengisi Nominal SOP. Kunci Data Agar Bisa <span class="text-semibold">Diproses.</span>
	</div>
	@endif

	@if (Session::has('sukses_update'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengubah Nominal SOP. Kunci Data Agar Bisa <span class="text-semibold">Diproses.</span>
	</div>
	@endif

	@if (Session::has('sukses_import'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengimport Nominal SOP.
	</div>
	@endif
	
	<!-- Tabel detail siswa -->
	<div class="panel panel-flat" style="position: static;">
		<div class="panel-heading">
			<h5 class="panel-title">Daftar Detail Siswa Belum Terkunci</h5>
			<div class="heading-elements">
				<a href="{{ url('sarpras/detailsiswa/lockall') }}">
					<button type="button" class="btn btn-warning btn-sm legitRipple" onclick="return confirm('Setelah Dikunci Data Tidak Bisa Diubah. Apakah Anda Yakin Akan Mengunci Semua Detail Siswa Ini?');"><i class="icon-lock position-left"></i>Kunci Semua</button>
				</a>
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>

		<div class="table-responsive" style="display: block;">
			<table class="table datatable-basic table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>NIS</th>
						<th>Nama Siswa</th>
						<th>Kelas</th>
						<th>Nominal SOP</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($detailsiswa as $row)
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->nis;?></td>
						<td><?php echo $row->nama_siswa;?></td>
						<td><?php echo $row->tingkat_kelas;?> <?php echo $row->jurusan_kelas;?> <?php echo $row->kode_kelas;?></td>
						<td>Rp.<?php echo number_format($row->nominal_sop,'0','','.');?>,-</td>
						@if($row->aksi=='tidak-terkunci')
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="{{ url('sarpras/detailsiswa/edit/'.$row->id_detail_siswa) }}"><i class="icon-pencil"></i> Edit Nominal SOP</a></li>
										<li><a href="{{ url('sarpras/detailsiswa/lock/'.$row->id_detail_siswa) }}" onclick="return confirm('Setelah Dikunci Data Tidak Bisa Diubah. Apakah Anda Yakin Akan Mengunci Detail Siswa Ini?');"><i class="icon-lock"></i> Kunci Nominal SOP</a></li>
									</ul>
								</li>
							</ul>
						</td>
						@elseif($row->aksi=='terkunci')
						<td>
							<a href="{{ url('sarpras/detailsiswa/show/'.$row->id_detail_siswa) }}"><span class="label label-info"><i class="icon-eye"></i>&nbsp;Lihat Detail Siswa</a>
						</td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- /tabel detail siswa -->

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