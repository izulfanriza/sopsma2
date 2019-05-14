@extends('layouts.index')

@section('content')

<!-- Content area -->
<div class="content">
	
	@if (Session::has('sukses_simpan'))
	<div class="alert alert-success no-border">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil menyimpan data. Kunci data agar dapat <span class="text-semibold">Diproses.</span>
	</div>
	@endif

	@if (Session::has('sukses_update'))
	<div class="alert alert-success no-border">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil mengubah data.
	</div>
	@endif

	@if (Session::has('sukses_hapus'))
	<div class="alert alert-success no-border">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil menghapus data.
	</div>
	@endif

	@if (Session::has('sukses_kunci'))
	<div class="alert alert-success no-border">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil mengunci data. Sekarang Data ini dapat <span class="text-semibold">Diproses.</span>
	</div>
	@endif


	<!-- Tabel detail siswa -->
	<div class="panel panel-flat" style="position: static;">
		<div class="panel-heading">
			<h5 class="panel-title">Daftar Detail Siswa Belum Isi Nominal SOP</h5>
			<div class="heading-elements">
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_theme_primary"><i class="icon-import position-left"></i>Import Nominal SOP</button>
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
										<li><a href="{{ url('sarpras/detailsiswa/edit/'.$row->id_detail_siswa) }}"><i class="icon-pencil"></i> Isi Nominal SOP</a></li>
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

<!-- Primary modal -->
<div id="modal_theme_primary" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ url('sarpras/detailsiswa1-import') }}" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
				
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h6 class="modal-title">IMPORT NOMINAL SOP</h6>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label for="export" class="control-label col-lg-8">Sebelum Mengimport Pastikan Format Excel Sesuai Template</label>
						<div class="col-lg-4">
							<a href="{{ url('sarpras/detailsiswa1-export') }}" class="btn btn-success btn-sm">Export Template <i class="icon-file-download2 position-right"></i></a>
							<span class="help-block with-errors"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Pilih File :</label>
						<div class="col-lg-10">
							<input type="file" name="file" class="file-styled">
						</div>
					</div>

					<div class="modal-footer">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-primary btn-sm legitRipple">Import <i class="icon-file-upload2 position-right"></i></button>
					</div>

				</div>

			</form>
		</div>
	</div>
</div>
<!-- /primary modal -->


@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection