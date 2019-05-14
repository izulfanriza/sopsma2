@extends('layouts.index')

@section('content')

<!-- Content area -->
<div class="content">
	
	@if (Session::has('sukses_kunci'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengunci Data. Sekarang Data Ini Dapat <span class="text-semibold">Diproses.</span>
	</div>
	@endif

	<!-- Tabel detail siswa -->
	<div class="panel panel-flat" style="position: static;">
		<div class="panel-heading">
			<h5 class="panel-title">Daftar Detail Siswa Terkunci</h5>
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
						<th>Nama Siswa</th>
						<th>Kelas</th>
						<th>Nominal SOP</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($detailsiswa as $row)
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->nis;?></td>
						<td><?php echo $row->nama_siswa;?></td>
						<td><?php echo $row->tingkat_kelas;?> <?php echo $row->jurusan_kelas;?> <?php echo $row->kode_kelas;?></td>
						<td>Rp. <?php echo number_format($row->nominal_sop,'0','','.');?>,-</td>
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