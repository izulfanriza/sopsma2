@extends('layouts.index')

@section('content')

				<!-- Content area -->
				<div class="content">

				@if (Session::has('sukses_simpan'))
				<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
					<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Sukses!</span> &bull; Berhasil Menambah Siswa Pada Kelas Ini.
				</div>
				@endif

				@if (Session::has('sukses_simpan_siswa'))
				<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
					<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengimport Siswa Pada Kelas Ini.
				</div>
				@endif

					<div class="panel panel-flat" style="position: static;">
						<div class="panel-heading">
							<h5 class="panel-title">Daftar Siswa Kelas <?php echo $kelas->tingkat_kelas;?> <?php echo$kelas->jurusan_kelas;?> <?php echo$kelas->kode_kelas ;?></h5>
								<div class="heading-elements">
									<a href="{{ url('sarpras/kelas') }}">
										<button type="button" class="btn btn-default btn-sm legitRipple"><i class="icon-arrow-left52 position-left"></i>Kembali</button>
									</a>
									<a href="{{ url('sarpras/kelas/tambahsiswa/'.$kelas->id_kelas) }}">
										<button type="button" class="btn btn-primary btn-sm legitRipple"><i class="icon-plus3 position-left"></i>Tambah Siswa</button>
									</a>
									<a>
										<button type="button" class="btn btn-info btn-sm legitRipple" data-toggle="modal" data-target="#modal_theme_primary"><i class="icon-import position-left"></i>Import Siswa</button>
									</a>
		                		</div>
		                		<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		                		</div>

						<div class="table-responsive" style="display: block;">
							<table class="table datatable-basic table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>NIS</th>
										<th>Nama</th>
										<th>Jenis Kelamin</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($detail as $row)
									<tr>
										<td><?php echo $row->nis ;?></td>
										<td><?php echo $row->nama_siswa ;?></td>
										<td><?php if($row->jenis_kelamin == 'L') echo "Laki-laki"; else echo "Perempuan" ;?></td>
										<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-menu9"></i>
													</a>
													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="{{ url('sarpras/detailsiswa/delete/'.$row->id_detail_siswa) }}" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Siswa Ini?');"><i class="icon-trash"></i> Hapus Dari Kelas</a></li>
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
					<!-- /tabel kelas -->
					
				</div>
				<!-- /content area -->

<!-- Primary modal -->
<div id="modal_theme_primary" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ url('sarpras/kelas/imp/'.$kelas->id_kelas.'/import') }}" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
				
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h6 class="modal-title">IMPORT SISWA DI KELAS</h6>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label for="export" class="control-label col-lg-8">Sebelum Mengimport Pastikan Format Excel Sesuai Template</label>
						<div class="col-lg-4">
							<a href="{{ url('sarpras/kelas/downloadsiswa') }}" class="btn btn-success btn-sm">Export Template <i class="icon-file-download2 position-right"></i></a>
							<span class="help-block with-errors"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Pilih File :</label>
						<div class="col-lg-10">
							<input type="file" name="file" class="file-styled">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Kelas :</label>
						<div class="col-md-10">
							<select type="select" class="form-control" name="id_kelas" value="{{ old('id_kelas') }}">
                                <option value="<?php echo $kelas->id_kelas ;?>"><?php echo $kelas->tingkat_kelas ;?> <?php echo $kelas->jurusan_kelas ;?> <?php echo $kelas->kode_kelas ;?></option>
                            </select>
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

<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/uploader_bootstrap.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection