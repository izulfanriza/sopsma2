@extends('layouts.index')

@section('content')

<!-- Content area -->
<div class="content">

	@if (Session::has('sukses_nonaktif'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Menonaktifkan Siswa Ini.
	</div>
	@endif

	@if (Session::has('sukses_import_non'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Menonaktifkan Siswa.
	</div>
	@endif

	@if (Session::has('sukses_hapus'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Menghapus Data Siswa.
	</div>
	@endif

	<!-- Tabel siswa tidak aktif-->
	<div class="panel panel-flat" style="position: static;">
		<div class="panel-heading">
			<h5 class="panel-title">Daftar Siswa Tidak Aktif</h5>
			<div class="heading-elements">
				<a href="{{ url('sarpras/siswa/addnonaktif') }}">
					<button type="button" class="btn btn-primary btn-sm legitRipple"><i class="icon-plus3 position-left"></i>Tambah Siswa Tidak Aktif</button>
				</a>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_theme_primary"><i class="icon-import position-left"></i>Import Siswa Tidak Aktif</button>
				<a href="{{ url('sarpras/siswa/hapusall') }}" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Semua Siswa Tidak Aktif?');">
					<button type="button" class="btn btn-danger btn-sm legitRipple"><i class="icon-trash position-left"></i>Hapus Semua Siswa Tidak Aktif</button>
				</a>
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>

		<div class="table-responsive" style="display: block;">
			<table class="table datatable-basic table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>NO</th>
						<th>NIS</th>
						<th>Nama Siswa</th>
						<th>Jenis Kelamin</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($siswa as $row)
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $row->nis;?></td>
						<td><?php echo $row->nama_siswa;?></td>
						<td><?php if($row->jenis_kelamin == 'L') echo "Laki-laki"; else echo "Perempuan" ;?></td>
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="{{ url('sarpras/siswa/show/'.$row->nis) }}"><i class="icon-eye"></i> Lihat Siswa</a></li>
										<li><a href="{{ url('sarpras/siswa/delete/'.$row->nis) }}" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Siswa Ini?');"><i class="icon-trash"></i> Hapus Siswa</a></li>
									</ul>
								</li>
							</ul>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- /tabel siswa tidak aktif-->

</div>
<!-- /content area -->

<!-- Primary modal -->
<div id="modal_theme_primary" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ url('sarpras/siswa/nimport') }}" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
				
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h6 class="modal-title">IMPORT SISWA TIDAK AKTIF</h6>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label for="export" class="control-label col-lg-8">Sebelum Mengimport Pastikan Format Excel Sesuai Template</label>
						<div class="col-lg-4">
							<a href="{{ url('sarpras/siswa/nexport') }}" class="btn btn-success btn-sm">Export Template <i class="icon-file-download2 position-right"></i></a>
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

<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js') }}"></script>

@endsection