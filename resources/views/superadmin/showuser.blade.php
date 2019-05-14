@extends('layouts.index')

@section('content')

<!-- Content area -->
<div class="content">
	@if (Session::has('sukses_resetpassword'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mereset Password User Ini.
	</div>
	@endif

	@if (Session::has('sukses_update'))
	<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Sukses!</span> &bull; Berhasil Mengubah Data User Ini.
	</div>
	@endif

	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Data User</h5>
			<div class="heading-elements">
				<a href="{{ url('superadmin/users') }}">
					<button type="button" class="btn btn-default btn-sm legitRipple"><i class="icon-arrow-left52 position-left"></i>Kembali</button>
				</a>
			</div>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>

		<div class="panel-body">

			<form class="form-horizontal" action="{{ url('superadmin/users/edit/'.$users->id) }}">
				<fieldset class="content-group">
					<legend class="text-bold"></legend>

					<div class="form-group">
						<label class="control-label col-lg-2">Nama</label>
						<div class="col-lg-10">
							<input class="form-control" readonly="readonly" value="<?php echo $users->nama_petugas;?>" type="text">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Email</label>
						<div class="col-md-10">
							<input class="form-control" readonly="readonly" value="<?php echo $users->email;?>" type="text">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Role</label>
						<div class="col-md-10">
							<input class="form-control" readonly="readonly" value="<?php if($users->role == 'sarpras') echo "Sarana dan Prasarana"; else echo "Tata Usaha" ;?>" type="text">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2">Password</label>
						<div class="col-md-10">
							<a href="{{ url('superadmin/users/resetpassword/'.$users->id) }}">
								<span class="label label-warning"><i class="icon-reset"></i>&nbsp;Reset Password</span> 
							</a>
						</div>
					</div>

					<div class="form-group">
						<div class="text-right">
							{{ csrf_field() }}
							<button type="submit" class="btn btn-warning btn-sm legitRipple"><i class="icon-pencil position-left"></i>Edit</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>

</div>
<!-- /content area -->


@endsection

@section('js')

<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/form_inputs.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection