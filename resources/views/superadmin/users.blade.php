@extends('layouts.index')

@section('content')

<!-- Content area -->
<div class="content">
	
	@if (Session::has('sukses_simpan'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Membuat User Baru.
	</div>
	@endif

	@if (Session::has('sukses_hapus'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Menghapus User.
	</div>
	@endif

	<!-- Tabel users -->
	<div class="panel panel-flat" style="position: static;">
		<div class="panel-heading">
			<h5 class="panel-title">Daftar User</h5>
			<div class="heading-elements">
				<a href="{{ url('superadmin/users/add') }}">
					<button type="button" class="btn btn-primary btn-sm legitRipple"><i class="icon-plus3 position-left"></i>Tambah User</button>
				</a>
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>

		<div class="table-responsive" style="display: block;">
			<table class="table datatable-basic table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama User</th>
						<th>Email</th>
						<th>Role</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $row)
					<tr>
						<td><?php echo $no++;?>
						<td><?php echo $row->nama_petugas;?></td>
						<td><?php echo $row->email;?></td>
						<td><?php if($row->role == 'sarpras') echo "Sarana dan Prasarana"; else echo "Tata Usaha" ;?></td>
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="{{ url('superadmin/users/show/'.$row->id) }}"><i class="icon-eye"></i> Lihat User</a></li>
										<li><a href="{{ url('superadmin/users/delete/'.$row->id) }}" onclick="return sweetalert()"><i class="icon-trash"></i> Hapus User</a></li>
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
	<!-- /tabel users -->
	
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


<script type="text/javascript">
	
	function sweetalert() {
		swal({
			title: "Apakah Anda Yakin?",
			text: "Menghapus User Ini Tidak Dapat Mengembalikan Datanya Lagi!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#FF7043",
			confirmButtonText: "Ya, Hapus!",
			cancelButtonText: "Batal"
		});
	};

	function success(){
		swal({
			title: "Sukses!",
			text: "Berhasil Menambah User!",
			confirmButtonColor: "#66BB6A",
			type: "success"
		});
	};

</script>

@endsection