@extends('layouts.index')

@section('content')

<!-- Content area -->
<div class="content">

	@if (Session::has('sukses_unlock'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Membuka Kunci. Data Kelas Sekarang Bisa <span class="text-semibold">Diubah.</span>
	</div>
	@endif

	<!-- Tabel kelas -->
	<div class="panel panel-flat" style="position: static;">
		<div class="panel-heading">
			<h5 class="panel-title">Daftar Kelas</h5>
			<div class="heading-elements">
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
						<td><?php echo $no++;?></td>
						<td><?php echo $row->tingkat_kelas;?></td>
						<td><?php echo $row->jurusan_kelas;?></td>
						<td><?php echo $row->kode_kelas;?></td>
						@if($row->aksi=='tidak-terkunci')
						<td>
							<span class="label label-info">Tidak Terkunci</span>
						</td>
						@elseif($row->aksi=='terkunci')
						<td>
							<a href="{{ url('admin/kelas/unlock/'.$row->id_kelas) }}" onclick="return confirm('Apakah Anda Yakin Akan Membuka Kunci Kelas Ini?')"><span class="label label-warning"><i class="icon-unlocked"></i>&nbsp;Buka Kunci</a>
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