@extends('layouts.index')

@section('content')

				<!-- Content area -->
				<div class="content">
					<!-- Tabel siswa -->
					<div class="panel panel-flat" style="position: static;">
						<div class="panel-heading">
							<h5 class="panel-title">Daftar Siswa Aktif</h5>
								<div class="heading-elements">
									<a href="{{ url('sarpras/siswanonaktif') }}">
										<button type="button" class="btn btn-default legitRipple"><i class="icon-arrow-left52 position-left"></i>Kembali</button>
									</a>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

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
										<td>
											<a href="{{ url('sarpras/siswa/nonaktif/'.$row->nis) }}" onclick="return confirm('Yakin Akan Menonaktifkan Siswa Ini?');"><span class="label label-warning"><i class="icon-user-minus"></i>&nbsp;Non-Aktifkan Siswa</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<!-- /tabel siswa -->
					
				</div>
				<!-- /content area -->

			
@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/uploader_bootstrap.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js') }}"></script>

@endsection