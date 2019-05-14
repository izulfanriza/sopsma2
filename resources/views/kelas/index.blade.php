@extends('layouts.index')

@section('content')

<!-- Content area -->
<div class="content">

	@if (Session::has('sukses_simpan'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Membuat Kelas Baru. Kunci Kelas Ini Agar Dapat <span class="text-semibold">Digunakan.</span>
	</div>
	@endif

	@if (Session::has('sukses_import'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengimport Kelas. Kunci Kelas Agar Dapat <span class="text-semibold">Digunakan.</span>
	</div>
	@endif

	@if (Session::has('sukses_update'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengubah Data Kelas.
	</div>
	@endif

	@if (Session::has('sukses_hapus'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Menghapus Kelas.
	</div>
	@endif

	@if (Session::has('sukses_kunci'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengunci Data Kelas. Sekarang Kelas ini Dapat <span class="text-semibold">Digunakan.</span>
	</div>
	@endif

	<!-- Tabel kelas -->
	<div class="panel panel-flat" style="position: static;">
		<div class="panel-heading">
			<h5 class="panel-title">Daftar Kelas</h5>
			<div class="heading-elements">

				@if($count==0)
				<button type="button" class="btn btn-defaults btn-sm disabled"><i class="icon-info22 position-left"></i>Pilih Tahun Ajaran Terlebih Dahulu</button>
				@else
				<a href="{{ url('sarpras/kelas/lockall') }}" onclick="return confirm('Setelah Dikunci Data Tidak Bisa Diubah. Apakah Anda Yakin Akan Mengunci Semua Kelas?');">
					<button type="button" class="btn btn-warning btn-sm legitRipple"><i class="icon-lock position-left"></i>Kunci Semua Kelas</button>
				</a>
				<a href="{{ url('sarpras/kelas/add') }}">
					<button type="button" class="btn btn-primary btn-sm legitRipple"><i class="icon-plus3 position-left"></i>Tambah Kelas</button>
				</a>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_theme_primary"><i class="icon-import position-left"></i>Import Kelas</button>
				@endif

			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>

		<div class="table-responsive" style="display: block;">
			<table class="table datatable-basic table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Tingkat Kelas</th>
						<th>Jurusan Kelas</th>
						<th>Kode Kelas</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($kelas as $row)
					<tr>
						<td><?php echo $no++;?>
						<td><?php echo $row->tingkat_kelas;?></td>
						<td><?php echo $row->jurusan_kelas;?></td>
						<td><?php echo $row->kode_kelas;?></td>
						@if($row->aksi=='tidak-terkunci')
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="{{ url('sarpras/kelas/edit/'.$row->id_kelas) }}"><i class="icon-pencil"></i> Edit Kelas</a></li>
										<li><a href="{{ url('sarpras/kelas/delete/'.$row->id_kelas) }}" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Kelas Ini?');"><i class="icon-trash"></i> Hapus Kelas</a></li>
										<li><a href="{{ url('sarpras/kelas/lock/'.$row->id_kelas) }}" onclick="return confirm('Setelah Dikunci Data Tidak Bisa Diubah. Apakah Anda Yakin Akan Mengunci Kelas Ini?');"><i class="icon-lock"></i> Kunci Kelas</a></li>
									</ul>
								</li>
							</ul>
						</td>
						@elseif($row->aksi=='terkunci')
						<td>
							<a href="{{ url('sarpras/kelas/show/'.$row->id_kelas) }}"><span class="label label-info"><i class="icon-eye"></i>&nbsp;Lihat Isi Kelas</a>
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


<!-- Primary modal -->
<div id="modal_theme_primary" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ url('sarpras/kelas/import') }}" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
				
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h6 class="modal-title">IMPORT KELAS</h6>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label for="export" class="control-label col-lg-8">Sebelum Mengimport Pastikan Format Excel Sesuai Template</label>
						<div class="col-lg-4">
							<a href="{{ url('sarpras/kelas/downloadkelas') }}" class="btn btn-success btn-sm">Download Template <i class="icon-file-download2 position-right"></i></a>
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
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection